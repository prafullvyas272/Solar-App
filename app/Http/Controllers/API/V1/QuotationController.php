<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Quotation;
use App\Models\Customer;
use App\Models\SolarDetail;
use App\Models\Sequence;
use App\Helpers\ApiResponse;
use App\Constants\ResMessages;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdateQuotationRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\QuotationItem;
use Illuminate\Support\Facades\Log;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = DB::table('quotations')
                ->leftJoin('customers', 'quotations.customer_id', '=', 'customers.id')
                ->leftJoin('users', 'users.id', '=', 'quotations.by')
                ->leftJoin('quotation_items', 'quotation_items.quotation_id', '=', 'quotations.id')
                ->select(
                    'quotations.id',
                    DB::raw("CONCAT(customers.first_name, ' ', customers.last_name) as customer_name"),
                    'quotations.required',
                    'quotations.amount',
                    'quotations.date',
                    'quotations.status',
                    DB::raw("CONCAT(users.first_name, ' ', users.last_name) as prepared_by"),
                    DB::raw("JSON_ARRAYAGG(
                        JSON_OBJECT(
                            'id', quotation_items.id,
                            'item_name', quotation_items.item_name,
                            'hsn', quotation_items.hsn,
                            'quantity', quotation_items.quantity,
                            'rate', quotation_items.rate,
                            'tax', quotation_items.tax
                        )
                    ) as items")
                )
                ->whereNull('quotations.deleted_at')
                ->groupBy('quotations.id')
                ->orderBy('quotations.id', 'desc')
                ->get();



        return ApiResponse::success($quotations, ResMessages::RETRIEVED_SUCCESS);
    }
    public function store(StoreUpdateQuotationRequest $request)
    {
        DB::beginTransaction();

        try {
            $sequence = Sequence::where('type', 'customerNumber')->first();
            $newSequenceNo = $sequence->sequenceNo + 1;
            $customerNumber = $sequence->prefix . '-' . str_pad($newSequenceNo, 4, '0', STR_PAD_LEFT);
            // 1. Store customer data
            $customer = Customer::create([
                'customer_number'   => $customerNumber,
                'first_name'     => $request->input('first_name'),
                'middle_name'     => $request->input('middle_name'),
                'last_name'     => $request->input('last_name'),
                'email'     => $request->input('email'),
                'pan_number'     => $request->input('pan_number'),
                'aadhar_number'     => $request->input('aadhar_number'),
                'age'               => $request->input('age'),
                'gender'            => $request->input('gender'),
                'marital_status'    => $request->input('marital_status'),
                'mobile'            => $request->input('mobile'),
                'alternate_mobile'  => $request->input('alternate_mobile'),
                'PerAdd_state'  => $request->input('PerAdd_state'),
                'district'  => $request->input('district'),
                'PerAdd_city'  => $request->input('PerAdd_city'),
                'PerAdd_pin_code'  => $request->input('PerAdd_pin_code'),
                'customer_address'           => $request->input('customer_address'),
                'customer_residential_address' => $request->input('customer_residential_address'),
                'assign_to'         => 0,
                'created_at'        => now(),
            ]);
            Sequence::where('type', 'customerNumber')->update(['sequenceNo' => $newSequenceNo]);

            // 2. Store quotation data
            $quotation = Quotation::create([
                'customer_id' => $customer->id,
                'required'    => $request->input('quotation_'),
                'amount'      => $request->input('quotation_amount'),
                'date'        => $request->input('quotation_date'),
                'by'          => Auth::user()->id,
                'status'      => $request->input('quotation_status'),
                'channel_partner_id' => $request->input('channel_partner'),
                'created_at'  => now(),
            ]);

            $this->createOrUpdateQuotationItem($request->input('items') , $quotation->id);

            // 2. Store quotation data
            $SolarDetail = SolarDetail::create([
                'customer_id' => $customer->id,
                'capacity' => $request->input('solar_capacity'),
                'roof_area' => $request->input('rooftop_size'),
                'created_at'  => now(),
            ]);

            DB::commit();

            return ApiResponse::success($quotation, ResMessages::CREATED_SUCCESS);
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Failed to store quotation: ' . $e->getMessage(), 500);
        }
    }
    public function view(Request $request)
    {
        $quotationId = $request->quotesId;
        $isCustomer = $request->is_customer;

        $query = Quotation::with([
            'customer',
            'customer.solarDetail',
            'quotationItems'
        ])
        ->select(
            'id',
            'customer_id',
            'required',
            'amount',
            'date',
            'by',
            'status',
            'channel_partner_id'
        );

        if ($isCustomer == 1) {
            $query->where('customer_id', $quotationId);
        } else {
            $query->where('id', $quotationId);
        }

        $quotation = $query->first();

        if ($quotation) {
            // Flatten the data to match the original select
            $data = [
                'id' => $quotation->id,
                'first_name' => $quotation->customer->first_name ?? null,
                'middle_name' => $quotation->customer->middle_name ?? null,
                'last_name' => $quotation->customer->last_name ?? null,
                'email' => $quotation->customer->email ?? null,
                'pan_number' => $quotation->customer->pan_number ?? null,
                'aadhar_number' => $quotation->customer->aadhar_number ?? null,
                'age' => $quotation->customer->age ?? null,
                'gender' => $quotation->customer->gender ?? null,
                'marital_status' => $quotation->customer->marital_status ?? null,
                'mobile' => $quotation->customer->mobile ?? null,
                'alternate_mobile' => $quotation->customer->alternate_mobile ?? null,
                'PerAdd_pin_code' => $quotation->customer->PerAdd_pin_code ?? null,
                'PerAdd_city' => $quotation->customer->PerAdd_city ?? null,
                'district' => $quotation->customer->district ?? null,
                'PerAdd_state' => $quotation->customer->PerAdd_state ?? null,
                'customer_address' => $quotation->customer->customer_address ?? null,
                'customer_residential_address' => $quotation->customer->customer_residential_address ?? null,
                'required' => $quotation->required,
                'capacity' => $quotation->customer->solarDetail->capacity ?? null,
                'roof_area' => $quotation->customer->solarDetail->roof_area ?? null,
                'amount' => $quotation->amount,
                'date' => $quotation->date,
                'by' => $quotation->by,
                'status' => $quotation->status,
                'channel_partner_id' => $quotation->channel_partner_id,
                'quotation_items' => $quotation->quotationItems->toArray(),
            ];


            return ApiResponse::success($data, ResMessages::RETRIEVED_SUCCESS);
        } else {
            return ApiResponse::error(null, ResMessages::NOT_FOUND);
        }
    }


    public function update(StoreUpdateQuotationRequest $request)
    {
        DB::beginTransaction();

        try {
            // 1. Fetch quotation
            $quotation = Quotation::findOrFail($request->input('quotesId'));

            // 2. Fetch associated customer
            $customer = Customer::findOrFail($quotation->customer_id);

            // 3. Update customer data
            $customer->update([
                'first_name'     => $request->input('first_name'),
                'middle_name'     => $request->input('middle_name'),
                'last_name'     => $request->input('last_name'),
                'email'     => $request->input('email'),
                'pan_number'     => $request->input('pan_number'),
                'aadhar_number'     => $request->input('aadhar_number'),
                'age'               => $request->input('age'),
                'gender'            => $request->input('gender'),
                'marital_status'    => $request->input('marital_status'),
                'mobile'            => $request->input('mobile'),
                'alternate_mobile'  => $request->input('alternate_mobile'),
                'PerAdd_state'  => $request->input('PerAdd_state'),
                'district'  => $request->input('district'),
                'PerAdd_city'  => $request->input('PerAdd_city'),
                'PerAdd_pin_code'  => $request->input('PerAdd_pin_code'),
                'customer_address'           => $request->input('customer_address'),
                'customer_residential_address' => $request->input('customer_residential_address'),
                'assign_to'         => 0,
                'updated_at'        => now(),
            ]);

            // 4. Update quotation data
            $quotation->update([
                'required'    => $request->input('quotation_'),
                'amount'      => $request->input('quotation_amount'),
                'date'        => $request->input('quotation_date'),
                'status'      => $request->input('quotation_status'),
                'channel_partner_id' => $request->input('channel_partner'),
                'updated_at'  => now(),
            ]);

            $this->createOrUpdateQuotationItem($request->input('items'), $quotation->id);

            $SolarDetail = SolarDetail::where('customer_id', $customer->id)->first();
            $SolarDetail->update([
                'capacity' => $request->input('solar_capacity'),
                'roof_area' => $request->input('rooftop_size'),
                'updated_at'  => now(),
            ]);

            DB::commit();

            return ApiResponse::success($quotation, 'Updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::error('Update failed: ' . $e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        $quotation = Quotation::find($id);
        $customer = Customer::where('id', $quotation->customer_id)->first();
        $customer->delete();

        if ($quotation) {
            $quotation->delete();
            return ApiResponse::success($quotation, ResMessages::DELETED_SUCCESS);
        } else {
            return ApiResponse::error($quotation, ResMessages::NOT_FOUND);
        }
    }
    public function getAllAccountantList()
    {
        $quotations = DB::table('users')
            ->select(
                'users.id',
                DB::raw('CONCAT(users.first_name, " ", users.last_name) AS full_name')
            )
            ->where('users.role_id', 4)
            ->whereNull('users.deleted_at')
            ->get();

        return ApiResponse::success($quotations, ResMessages::RETRIEVED_SUCCESS);
    }

    public function download(Request $request)
    {
        try {
            $id = $request->input('id');

            if (!$id) {
                return ApiResponse::error('Quotation ID is required', 400);
            }



            // Step 1: Get the quotation by ID
            // Use Eloquent to minimize queries and eager load relationships

            $quotation = Quotation::with([
                'customer' => function ($query) {
                    $query->whereNull('deleted_at');
                },
                'customer.solarDetail' => function ($query) {
                    $query->whereNull('deleted_at');
                },
                'quotationItems',
            ])
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->first();


            if (!$quotation) {
                return ApiResponse::error('Quotation not found', 404);
            }

            $customer = $quotation->customer;
            $solar_detail = $customer->solarDetail ?? null;

            $quotationData = array_merge(
                [
                    'capacity' => $solar_detail->capacity ?? null,
                    'roof_area' => $solar_detail->roof_area ?? null,
                    'customer' => $customer,
                    'customer_full_address' => implode(', ', array_filter([
                        $customer->customer_address ?? null,
                        $customer->PerAdd_city ?? null,
                        $customer->district ?? null,
                        $customer->PerAdd_state ?? null,
                        $customer->PerAdd_pin_code ?? null,
                    ])),
                    'quotation' => $quotation,
                    'solar_detail' => $solar_detail,
                    'quotation_items' => $quotation->quotationItems,
                ]
            );


                /**
                 * Customer address
                 * Quotation No. Quotation Date, Expiry Date
                 * Item details
                 * eg HSN, QTY. ,RATE, TAX ,AMOUNT
                 * totaltax, totalamount
                 *
                 */

            if (!$quotation) {
                return ApiResponse::error('Quotation not found', 404);
            }

            // Generate PDF using a PDF library (like DomPDF or TCPDF)
            $pdf = \PDF::loadView('client.quotation', compact('quotationData'));

            $filename = 'quotation_' . $quotation->customer_number . '_' . date('Y-m-d') . '.pdf';

            return $pdf->stream($filename);

        } catch (\Exception $e) {
            return ApiResponse::error('Download failed: ' . $e->getMessage(), 500);
        }
    }


    /**
     * Method to create quotation items
     */
    public function createOrUpdateQuotationItem($quotationItems, $quotationId)
    {
        try {
            $authUser = Auth::user();
            $existingQuotationItems = QuotationItem::whereQuotationId($quotationId)->pluck('id')->toArray();   // [1,2]

            // Delete items that are removed now from form
            if (!empty($existingQuotationItems)) {
                $payloadQuotationItemsId = collect($quotationItems)->map(function($item) {
                    return $item['item_id'];
                })->toArray();

                foreach ($existingQuotationItems as $key => $existingQuotationItemId) {
                    if (!in_array($existingQuotationItemId, $payloadQuotationItemsId )) {
                        QuotationItem::whereId($existingQuotationItemId)->delete();
                    }
                }
            }

            foreach ($quotationItems as $item) {
                QuotationItem::updateOrCreate([
                    'id' => $item['item_id'],
                ],[
                    'quotation_id' => $quotationId,
                    'created_by' => $authUser['id'],
                    'item_name' => $item['item_name'],
                    'hsn' => $item['hsn'],
                    'rate' => $item['rate'],
                    'quantity' => $item['quantity'],
                    'tax' => $item['tax'],
                ]);
            }

            return response()->json([
                'status' => 201,
                'message' => 'Quotation item created.'
            ], 201);

        } catch (\Throwable $exception) {
            Log::error('Failed to create quotation item(s): ' . $exception->getMessage(), [
                'exception' => $exception,
                'quotation_id' => $quotationId,
                'items' => $quotationItems
            ]);
            return response()->json([
                'message' => 'Something went wrong.'
            ]);
        }

    }
}

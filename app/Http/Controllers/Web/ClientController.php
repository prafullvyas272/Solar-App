<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\MenuPermissionsController;
use App\Http\Controllers\API\V1\ClientController as APIClientController;
use App\Helpers\JWTUtils;
use App\Enums\RoleType;
use App\Models\Product;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $request->merge(['AccessCode' => config('menuAccessCode.CLIENTLIST')]);

        $apiController = new MenuPermissionsController();
        $response = $apiController->index($request);

        $responseData = $response->getData(true);

        $permissions = $responseData['data'] ?? [];

        $menuName = $permissions['menu_name'] ?? '';

        if (empty($permissions) || empty($permissions['canView'])) {
            return response()->view('errors.401');
        }

        $cookieData = json_decode(request()->cookie('user_data'), true);

        $roleCode = $cookieData['role_code'] ?? null;

        $employeeRoleID = RoleType::EMPLOYEE->value;

        $disableAcceptButton = ($roleCode !== 'EMPLOYEE');

        return view('client.client_index', ['permissions' => $permissions, 'menuName' => $menuName, 'roleCode' => $roleCode , 'disableAcceptButton' => $disableAcceptButton]);
    }

    public function create(Request $request)
    {
        $clientId = $request->input('id');
        $inverterCompanies = \App\Models\InverterCompany::orderBy('name')->get();
        $panelTypes = \App\Models\PanelType::orderBy('name')->get();
        $solarCompanies = \App\Models\SolarPanelCompany::orderBy('name')->get();

        $solarPanelSerialNumbers = Product::where([
            ['assigned_to', '=', $clientId],
            ['product_category_id', '=', 1],     // Solar Panel Category ID = 1
        ])->get();

        return view('client.client_create', [
            'clientId' => $clientId,
            'inverterCompanies' => $inverterCompanies,
            'panelTypes' => $panelTypes,
            'solarCompanies' => $solarCompanies,
            'solarPanelSerialNumbers' => $solarPanelSerialNumbers,
        ]);
    }
    public function showDetails(Request $request, $id)
    {
        $request->merge(['id' => $id]);

        $apiController = new APIClientController();
        $response = $apiController->ClientDetails($request);

        $responseData = $response->getData(true);

        $client = $responseData['data']['customer'] ?? [];
        $solar_detail = $responseData['data']['solar_detail'] ?? [];
        $subsidy = $responseData['data']['subsidy'] ?? [];
        $customer_bank_detail = $responseData['data']['customer_bank_detail'] ?? [];
        $loan_bank_detail = $responseData['data']['loan_bank_detail'] ?? [];
        $appDocument = $responseData['data']['appDocument'] ?? [];

        return view('client.client_details', compact('client', 'solar_detail', 'subsidy', 'customer_bank_detail', 'loan_bank_detail', 'appDocument'));
    }

    public function uploadDocuments(Request $request)
    {
        $clientId = $request->input('id');

        return view('client.client_document', compact('clientId'));
    }
}

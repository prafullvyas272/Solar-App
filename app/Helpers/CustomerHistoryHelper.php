<?php

namespace App\Helpers;

use App\Models\CustomerHistory;
use App\Models\Customer;
use App\Enums\HistoryType;

class CustomerHistoryHelper
{
    /**
     * Store customer history
     *
     * @return void
     */
    public static function storeCustomerHistory($customer, $solarData, $authUser, $historyType = null, $comment = null)
    {
        try {
            if ($historyType == HistoryType::CREATED) {
                $comment = 'Customer ' . $customer->customer_number . ' Created By ' . $authUser->first_name . ' ' . $authUser->last_name;
            }
            if ($historyType == HistoryType::UPDATED) {
                $comment = 'Customer ' . $customer->customer_number . ' Updated By ' . $authUser->first_name . ' ' . $authUser->last_name;
            }
            if ($historyType == HistoryType::ASSIGNED) {
                $customerName = $customer->first_name . ' ' . $customer->middle_name . ' ' . $customer->last_name;
                $comment = $solarData['number_of_panels'] .  ' Solar Panels and Inverter with Serial Number' . $solarData['inverter_serial_number'] . ' is Assigned to ' . $customerName . ' By ' . $authUser->first_name . ' ' . $authUser->last_name;
            }

            CustomerHistory::create([
                'customer_id' => $customer->id,
                'updated_by' => $authUser->id,
                'history_type' => $historyType,
                'comment' => $comment,
            ]);
        } catch (\Exception $e) {
            dd($e);
            // You can log the error or handle it as needed
            // For example: \Log::error('Failed to store customer history: ' . $e->getMessage());
        }
    }




}

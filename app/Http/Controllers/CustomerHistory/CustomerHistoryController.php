<?php

namespace App\Http\Controllers\CustomerHistory;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerHistoryController extends Controller
{
    public function index(Customer $customer)
    {
        $customerHistories = $customer->histories()->orderBy('id', 'desc')->get();
        return view('customer-history.index', compact('customerHistories'));
    }
}

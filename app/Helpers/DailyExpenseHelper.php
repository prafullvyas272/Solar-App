<?php

namespace App\Helpers;

use App\Enums\TransactionType;
use App\Helpers\JWTUtils;
use App\Models\DailyExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DailyExpenseHelper
{
    public static function getExpenseDataByYear(Request $request)
    {
        $year = $request->input('year') ? (int)$request->input('year') : (int)Carbon::now()->format('Y');
        $expenseData = [];
        $incomeData = [];
        $profitData = [];
        $allData = DailyExpense::all();

        $customDate = $request->input('customDate');
        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');

        if ($customDate) {
            $totalNetExpense = $allData->where('date', $customDate)->where('transaction_type', TransactionType::EXPENSE->value)->sum('amount');
            $totalNetIncome = $allData->where('date', $customDate)->where('transaction_type', TransactionType::INCOME->value)->sum('amount');
        }

        if ($fromDate && $toDate) {
            $totalNetExpense = $allData->whereBetween('date', [$fromDate, $toDate])->where('transaction_type', TransactionType::EXPENSE->value)->sum('amount');
            $totalNetIncome = $allData->whereBetween('date', [$fromDate, $toDate])->where('transaction_type', TransactionType::INCOME->value)->sum('amount');
        }

        if (!$customDate && !$fromDate && !$toDate) {
            $totalNetExpense = $allData->where('transaction_type', TransactionType::EXPENSE->value)->sum('amount');
            $totalNetIncome = $allData->where('transaction_type', TransactionType::INCOME->value)->sum('amount');
        }

        $totalNetProfit = $totalNetIncome - $totalNetExpense;


        for ($i = 1; $i <= 12; $i++) {
            $monthStartDate = Carbon::createFromDate($year, $i, 1)->startOfMonth()->format('Y-m-d');
            $monthEndDate = Carbon::createFromDate($year, $i, 1)->endOfMonth()->format('Y-m-d');
            $monthlyExpenseAmount = DailyExpense::whereTransactionType(TransactionType::EXPENSE->value)->whereBetween('date', [$monthStartDate, $monthEndDate])->sum('amount');
            $monthlyIncomeAmount = DailyExpense::whereTransactionType(TransactionType::INCOME->value)->whereBetween('date', [$monthStartDate, $monthEndDate])->sum('amount');

            $expenseData[] = $monthlyExpenseAmount;
            $incomeData[] = $monthlyIncomeAmount;
            $profitData[] = $monthlyIncomeAmount - $monthlyExpenseAmount;
        }

        return [
            'totalNetExpense' => $totalNetExpense,
            'totalNetIncome' => $totalNetIncome,
            'totalNetProfit' => $totalNetProfit,
            'expenseData' => $expenseData,
            'incomeData' => $incomeData,
            'profitData' => $profitData,
        ];

    }
}

<?php

namespace App\Helpers;

use App\Enums\TransactionType;
use App\Helpers\JWTUtils;
use App\Models\DailyExpense;
use App\Models\ExpenseCategory;
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


    public static function getCategoryExpenseDataByYearAndMonth(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('monthIndex') + 1;   // If Index is 0 , then month will be 0 + 1 January
        $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth()->format('Y-m-d');

        $expenseData = DailyExpense::whereBetween('date', [$startOfMonth , $endOfMonth])->whereTransactionType(TransactionType::EXPENSE->value)->get();
        $incomeData = DailyExpense::whereBetween('date', [$startOfMonth , $endOfMonth])->whereTransactionType(TransactionType::INCOME->value)->get();

        $expenseCategories = array_values(array_unique($expenseData->pluck('expense_category_id')->toArray()));
        $incomeCategories  = array_values(array_unique($incomeData->pluck('expense_category_id')->toArray()));

        return self::getFormattedDataByCategoryWise($expenseData, $expenseCategories, $incomeData, $incomeCategories);

    }


    public static function getFormattedDataByCategoryWise($expenseTransactionData, $expenesCategories, $incomeTransactionData, $incomeCategories)
    {
        $expenseData = $incomeData = [];
        $categories = ExpenseCategory::all();

        for ($i=0; $i < count($expenesCategories); $i++) {
            $expenseData[$i] = [
                'name' => $categories->where('id', $expenesCategories[$i])->first()['name'],
                'amount' => $expenseTransactionData->where('transaction_type', TransactionType::EXPENSE->value)->where('expense_category_id', $expenesCategories[$i])->sum('amount')
            ];
        }

        for ($i=0; $i < count($incomeCategories); $i++) {
            $incomeData[$i] = [
                'name' => $categories->where('id', $incomeCategories[$i])->first()['name'],
                'amount' => $incomeTransactionData->where('transaction_type', TransactionType::INCOME->value)->where('expense_category_id', $incomeCategories[$i])->sum('amount')
            ];
        }

        return [
            'monthly_expense_data' => $expenseData,
            'monthly_income_data' => $incomeData,
        ];

    }
}

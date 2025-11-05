<?php

namespace App\Http\Controllers\DailyExpense;

use App\Enums\PaymentMode;
use App\Enums\TransactionType;
use App\Helpers\DailyExpenseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\DailyExpense\StoreDailyExpenseRequest;
use App\Http\Requests\DailyExpense\UpdateDailyExpenseRequest;
use App\Models\Customer;
use App\Models\DailyExpense;
use App\Models\ExpenseCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
class DailyExpenseController extends Controller
{
    protected $dailyExpenseHelper;

    public function __construct(DailyExpenseHelper $dailyExpenseHelper)
    {
        $this->dailyExpenseHelper = $dailyExpenseHelper;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::all();
        $dailyExpenses = DailyExpense::with(['customer'])->get();
        $customers = Customer::all();
        $employees = User::whereRoleId(3)->get();  // id 3 for employees role
        $transactionTypes = TransactionType::cases();
        $paymentTypes = PaymentMode::getModes();


        return view('daily-expense.index', compact('dailyExpenses', 'expenseCategories', 'employees', 'customers', 'transactionTypes', 'paymentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $expenseCategories = ExpenseCategory::all();
        $paymentTypes = PaymentMode::getModes();
        $customers = Customer::all();
        $employees = User::whereRoleId(3)->get();  // id 3 for employees role
        $transactionTypes = TransactionType::cases();

        return view('daily-expense.create', compact('expenseCategories', 'paymentTypes', 'employees', 'customers', 'transactionTypes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dailyExpense = DailyExpense::findOrFail($id);
        $expenseCategories = ExpenseCategory::all();
        $paymentTypes = PaymentMode::getModes();
        $customers = Customer::all();
        $employees = User::whereRoleId(3)->get();  // id 3 for employees role

        return view('daily-expense.create', compact('dailyExpense', 'expenseCategories', 'paymentTypes', 'employees', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDailyExpenseRequest $request)
    {
        try {
            $data = $request->dailyExpenseData();

            // Handle receipt file upload if exists
            if ($request->hasFile('receipt_path')) {
                $file = $request->file('receipt_path');
                $path = $file->store('receipts', 'public');
                $data['receipt_path'] = $path;
            }

            DailyExpense::create($data);

            return redirect()->route('daily-expense.index')->with('success', 'Daily expense created successfully.');
        } catch (\Exception $e) {
            Log::error('Error saving daily expense: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'An error occurred while saving daily expense: ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyExpenseRequest $request, string $id)
    {
        try {
            $dailyExpense = DailyExpense::findOrFail($id);
            $data = $request->dailyExpenseData();

            // Handle receipt file upload if exists
            if ($request->hasFile('receipt_path')) {
                // Delete the old receipt if present
                if ($dailyExpense->receipt_path && Storage::disk('public')->exists($dailyExpense->receipt_path)) {
                    Storage::disk('public')->delete($dailyExpense->receipt_path);
                }
                $file = $request->file('receipt_path');
                $path = $file->store('receipts', 'public');
                $data['receipt_path'] = $path;
            }

            $dailyExpense->update($data);

            return redirect()->route('daily-expense.index')->with('success', 'Daily expense updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating daily expense: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withInput()->with('error', 'An error occurred while updating daily expense: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dailyExpense = DailyExpense::findOrFail($id);
        $dailyExpense->delete();

        return redirect()->route('daily-expense.index')
            ->with('success', 'Daily Expense deleted successfully.');
    }

    public function viewExpenseReports(Request $request)
    {
        $data = $this->getDailyExpenseData($request);
        return view('expense.reports', compact('data'));
    }

    public function getDailyExpenseData(Request $request)
    {
        return $this->dailyExpenseHelper->getExpenseDataByYear($request);
    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\superAdminDashboardController as ApiSuperAdminDashboardController;
use App\Http\Controllers\API\V1\usersController as ApiusersController;
use App\Models\LoanBankDetail;
use App\Models\Quotation;
use App\Models\SolarDetail;
use App\Models\Subsidy;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $cookieData = json_decode($request->cookie('user_data'), true);
        $roleCode = $cookieData['role_code'] ?? null;
        $name = $cookieData['name'] ?? null;
        $profileImg = $cookieData['profile_img'] ?? null;
        $authUser = Auth::user();

        $dashboardData = null;

        if ($roleCode === $this->employeeRoleCode || $roleCode === $this->AdminRoleCode) {
            $birthdayData = $this->getTodaysBirthday();
            $employeesList = $this->getEmployeesList($roleCode);
            $dashboardData = $this->fetchDashboardData($authUser, $roleCode);
        }


        if ($roleCode === $this->AdminRoleCode) {
            $dashboardData = $this->fetchDashboardData($authUser, $roleCode);

            return view('dashboard.admin_dashboard', compact('name', 'profileImg', 'birthdayData', 'employeesList', 'dashboardData'));
        }

        if ($roleCode === $this->superAdminRoleCode) {

            return view('dashboard.superAdmin_dashboard', compact('name', 'profileImg'));
        }

        if ($roleCode === $this->clientRoleCode) {
            $dashboardData = $this->fetchDashboardData($authUser, $roleCode);
        }

        return match ($roleCode) {
            $this->clientRoleCode => view('dashboard.client_dashboard', compact('name', 'profileImg', 'dashboardData')),
            default => view('dashboard.employee_dashboard', compact('name', 'profileImg', 'birthdayData', 'employeesList', 'dashboardData')),
        };
    }

    public function fetchDashboardData($authUser, $roleCode)
    {
        if ($roleCode === $this->employeeRoleCode) {
            $totalPendingCustomers = SolarDetail::where(['is_completed' => false, 'inserted_by' => $authUser->id])->count();
            $totalInstallationDone = SolarDetail::where(['is_completed' => true, 'inserted_by' => $authUser->id])->count();
            $totalSubsidyPending = Subsidy::where(['subsidy_status' => 'Pending', 'created_by' => $authUser->id])->count();
            $totalLoanPending = LoanBankDetail::where('loan_status', 'Pending')->where('created_by', $authUser->id)->count();
            $quotationPending = null;
        }

        if ($roleCode === $this->AdminRoleCode || $roleCode === $this->superAdminRoleCode || $roleCode === $this->clientRoleCode) {
            $totalPendingCustomers = SolarDetail::where(['is_completed' => false])->count();
            $totalInstallationDone = SolarDetail::where(['is_completed' => true])->count();
            $totalSubsidyPending = Subsidy::where(['subsidy_status' => 'Pending'])->count();
            $totalLoanPending = LoanBankDetail::where('loan_status', 'Pending')->count();
            $quotationPending = Quotation::where('status', 'Pending')->count();
        }

        return [
            'totalPendingCustomers' => $totalPendingCustomers,
            'totalInstallationDone' => $totalInstallationDone,
            'totalSubsidyPending' => $totalSubsidyPending,
            'totalLoanPending' => $totalLoanPending,
            'quotationPending' => $quotationPending,
        ];
    }


    public function getCompanyOverview()
    {
        $apiController = new ApiSuperAdminDashboardController();

        $response = $apiController->getCompanyNumber();

        return $response->getData(true)['data'] ?? [];
    }
    public function getTodaysBirthday()
    {
        $apiController = new ApiusersController();
        $response = $apiController->getTodaysBirthday();

        return $response->getData(true)['data'] ?? [];
    }
    public function getEmployeesList($roleCode)
    {
        if ($roleCode === $this->AdminRoleCode) {
            $isEmployee = false;
        } else {
            $isEmployee = true;
        }

        $apiController = new ApiusersController();
        $response = $apiController->getEmployeesList($isEmployee);

        return $response->getData(true)['data'] ?? [];
    }

    public function benefits()
    {
        return view('consumer.client_benefits');
    }
}

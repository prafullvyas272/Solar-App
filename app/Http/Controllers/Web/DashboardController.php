<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\superAdminDashboardController as ApiSuperAdminDashboardController;
use App\Http\Controllers\API\V1\usersController as ApiusersController;
use App\Models\LoanBankDetail;
use App\Models\SolarDetail;
use App\Models\Subsidy;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $cookieData = json_decode($request->cookie('user_data'), true);
        $roleCode = $cookieData['role_code'] ?? null;
        $name = $cookieData['name'] ?? null;
        $profileImg = $cookieData['profile_img'] ?? null;

        if ($roleCode === $this->employeeRoleCode || $roleCode === $this->AdminRoleCode) {
            $birthdayData = $this->getTodaysBirthday();
            $employeesList = $this->getEmployeesList($roleCode);
            $dashboardData = $this->fetchDashboardData();
        }

        if ($roleCode === $this->AdminRoleCode) {

            return view('dashboard.admin_dashboard', compact('name', 'profileImg', 'birthdayData', 'employeesList'));
        }

        if ($roleCode === $this->superAdminRoleCode) {

            return view('dashboard.superAdmin_dashboard', compact('name', 'profileImg'));
        }

        return match ($roleCode) {
            $this->clientRoleCode => view('dashboard.client_dashboard', compact('name', 'profileImg')),
            default => view('dashboard.employee_dashboard', compact('name', 'profileImg', 'birthdayData', 'employeesList', 'dashboardData')),
        };
    }

    public function fetchDashboardData()
    {
        $totalPendingCustomers = SolarDetail::where('is_completed', false)->count();
        $totalInstallationDone = SolarDetail::where('is_completed', true)->count();
        $totalSubsidyPending = Subsidy::where('subsidy_status', 'Pending')->count();
        $totalLoanPending = LoanBankDetail::whereNull('loan_status')->count();

        return [
            'totalPendingCustomers' => $totalPendingCustomers,
            'totalInstallationDone' => $totalInstallationDone,
            'totalSubsidyPending' => $totalSubsidyPending,
            'totalLoanPending' => $totalLoanPending
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

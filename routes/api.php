<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\RoleController;
use App\Http\Controllers\API\V1\MenuController;
use App\Http\Controllers\API\V1\usersController;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\RoleMenuPermissionController;
use App\Http\Controllers\API\V1\EmployeeProfileController;
use App\Http\Controllers\API\V1\MenuPermissionsController;
use App\Http\Controllers\API\V1\EmployeeDashboardController;
use App\Http\Controllers\API\V1\LeaveController;
use App\Http\Controllers\API\V1\AdminLeaveController;
use App\Http\Controllers\API\V1\AdminAttendanceController;
use App\Http\Controllers\API\V1\HolidayController;
use App\Http\Controllers\API\V1\DashboardController;
use App\Http\Controllers\API\V1\FinancialYearController;
use App\Http\Controllers\API\V1\CompanyController;
use App\Http\Controllers\API\V1\ClientController;
use App\Http\Controllers\API\V1\EmployeeController;
use App\Http\Controllers\API\V1\AdminDashboardController;
use App\Http\Controllers\API\V1\superAdminDashboardController;
use App\Http\Controllers\API\V1\AllowanceListController;
use App\Http\Controllers\API\V1\DeductionController;
use App\Http\Controllers\API\V1\EmployeeSalaryController;
use App\Http\Controllers\API\V1\EmailSettingsController;
use App\Http\Controllers\API\V1\NotificationSettingController;
use App\Http\Controllers\API\V1\ConsumerApplicationController;
use App\Http\Controllers\API\V1\ChannelPartnersController;
use App\Http\Controllers\API\V1\ManageBankController;
use App\Http\Controllers\API\V1\InstallersController;
use App\Http\Controllers\API\V1\QuotationController;


Route::prefix('V1')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
    Route::post('/change/password', [AuthController::class, 'changePassword'])->name('change.password');

    Route::post('/UploadFiles', [DashboardController::class, 'UploadFiles']);

    Route::get('/admin/Attendance/export', [AdminAttendanceController::class, 'exportAttendance']);
});

Route::middleware(['jwt.verify'])->group(function () {
    Route::prefix('V1')->group(function () {

        // Channel Partners
        Route::get('/channel-partners', [ChannelPartnersController::class, 'index']);
        Route::post('/channel-partners/create', [ChannelPartnersController::class, 'store']);
        Route::get('/channel-partners/view', [ChannelPartnersController::class, 'view']);
        Route::post('/channel-partners/update', [ChannelPartnersController::class, 'update']);
        Route::post('/channel-partners/delete/{id}', [ChannelPartnersController::class, 'delete']);
        Route::post('/channel-partners/upload-documents', [ChannelPartnersController::class, 'uploadDocuments']);
        Route::post('/channel-partners/delete-documents/{id}', [ChannelPartnersController::class, 'deleteDocuments']);

        // Manage Bank
        Route::get('/manage-bank', [ManageBankController::class, 'index'])->name('manage-bank');
        Route::post('/manage-bank/create', [ManageBankController::class, 'store']);
        Route::get('/manage-bank/view', [ManageBankController::class, 'view']);
        Route::post('/manage-bank/update', [ManageBankController::class, 'update']);
        Route::post('/manage-bank/delete/{id}', [ManageBankController::class, 'delete']);

        // INSTALLERS
        Route::get('/installers', [InstallersController::class, 'index']);
        Route::post('/installers/create', [InstallersController::class, 'store']);
        Route::get('/installers/view', [InstallersController::class, 'view']);
        Route::post('/installers/update', [InstallersController::class, 'update']);
        Route::post('/installers/delete/{id}', [InstallersController::class, 'delete']);

        // Quotations
        Route::get('/quotation', [QuotationController::class, 'index']);
        Route::post('/quotation/create', [QuotationController::class, 'store']);
        Route::get('/quotation/view', [QuotationController::class, 'view']);
        Route::post('/quotation/update', [QuotationController::class, 'update']);
        Route::post('/quotation/delete/{id}', [QuotationController::class, 'delete']);
        Route::get('/getAccountant-list', [QuotationController::class, 'getAllAccountantList']);

        // Client Application
        // Route::get('/client', [ClientController::class, 'index']);
        Route::get('/client-application', [ClientController::class, 'index']);
        Route::post('/client-application/accept', [ClientController::class, 'accept']);
        Route::post('/client-application/create', [ClientController::class, 'store']);
        Route::get('/client-application/view', [ClientController::class, 'view']);
        Route::post('/client-application/update', [ClientController::class, 'update']);
        Route::post('/client-application/delete/{id}', [ClientController::class, 'delete']);
        Route::post('/client-application/documents/upload', [ClientController::class, 'uploadDocuments']);

        Route::get('/download-annexure2', [ClientController::class, 'downloadAnnexure2']);

        Route::get('/download-provisional-agreement', [ClientController::class, 'downloadProvisionalAgreement']);
        Route::get('/download-pcr', [ClientController::class, 'downloadPCR']);
        Route::get('/quotation/download', [QuotationController::class, 'download']);
        Route::get('/download-ugvcl-report', [ClientController::class, 'downloadUGVCLReport']);
        Route::get('/download-client-details', [ClientController::class, 'downloadClientDetails']);




        Route::get('/client/details', [ClientController::class, 'showDetails']);

        Route::post('/set-year-filter', [AuthController::class, 'setYearFilter'])->name('set.year.filter');
        Route::post('/set-company-filter', [AuthController::class, 'setCompaniesFilter'])->name('set.companies.filter');


        // Get Menu Permissions
        Route::get('/getMenu', [MenuPermissionsController::class, 'getMenuByUserRights']);
        Route::get('/menu/permission', [MenuPermissionsController::class, 'index']);


        Route::post('/applications/create', [ConsumerApplicationController::class, 'create'])->name('Proposal.create');
        Route::get('/applications/list', [ConsumerApplicationController::class, 'index'])->name('Proposal.list');
        Route::get('/applications/documents/list', [ConsumerApplicationController::class, 'getDocumentsList'])->name('Proposal.documents.list');
        Route::post('/applications/delete/{id}', [ConsumerApplicationController::class, 'delete'])->name('Proposal.delete');
        Route::get('/applications/download/document', [ConsumerApplicationController::class, 'downloadDocument'])->name('Proposal.download.document');

        // Role
        Route::get('/roles', [RoleController::class, 'index']);
        Route::post('/roles/store', [RoleController::class, 'store']);
        Route::get('/roles/view', [RoleController::class, 'view']);
        Route::post('/roles/update', [RoleController::class, 'update']);
        Route::post('/roles/delete/{id}', [RoleController::class, 'delete']);

        //  Role & Menu  has Permission
        Route::post('/role-permissions', [RoleMenuPermissionController::class, 'store']);
        Route::get('/role-permissions/view/{id}', [RoleMenuPermissionController::class, 'view']);

        //Menu
        Route::get('/menu', [MenuController::class, 'index']);
        Route::post('/menu/store', [MenuController::class, 'store']);
        Route::get('/menu/view', [MenuController::class, 'view']);
        Route::post('/menu/update', [MenuController::class, 'update']);
        Route::post('/menu/delete/{id}', [MenuController::class, 'delete']);
        Route::post('/menu/reorder', [MenuController::class, 'menuReorder']);

        //Users
        Route::get('/user', [usersController::class, 'index']);
        Route::post('/user/store', [usersController::class, 'store']);
        Route::get('/user/view', [usersController::class, 'view']);
        Route::post('/user/update', [usersController::class, 'update']);
        Route::post('/user/delete/{id}', [usersController::class, 'delete']);

        // Notification
        Route::get('/notification', [usersController::class, 'showNotifications']);
        Route::post('/notification/markAsRead', [usersController::class, 'markAllAsRead']);
        Route::post('/notification/delete/{id}', [usersController::class, 'deleteNotification']);

        //Profile
        Route::get('/profile', [EmployeeProfileController::class, 'index']);
        Route::post('/profile/img', [EmployeeProfileController::class, 'AddEditImg']);
        Route::post('/profile', [EmployeeProfileController::class, 'AddEditProfile']);

        Route::post('/address', [EmployeeProfileController::class, 'AddEditAddress']);
        Route::post('/bankDetails/{id}', [EmployeeProfileController::class, 'AddEditBankDetails']);
        Route::post('/education/{id}', [EmployeeProfileController::class, 'AddEditEducation']);

        Route::post('/experience/{id}', [EmployeeProfileController::class, 'AddEditExperience']);
        Route::get('/experience/list/{id}', [EmployeeProfileController::class, 'ExperienceList']);
        Route::get('/experience/view/{id}', [EmployeeProfileController::class, 'ExperienceView']);
        Route::post('/experience/delete/{id}', [EmployeeProfileController::class, 'ExperienceDelete']);

        Route::post('/vehicle/{id}', [EmployeeProfileController::class, 'AddEditVehicle']);
        Route::get('/vehicle/list/{id}', [EmployeeProfileController::class, 'VehicleList']);
        Route::get('/vehicle/view/{id}', [EmployeeProfileController::class, 'VehicleView']);
        Route::post('/vehicle/delete/{id}', [EmployeeProfileController::class, 'VehicleDelete']);

        Route::post('/documents/{id}', [EmployeeProfileController::class, 'AddEditDocuments']);
        Route::post('/job/{id}', [EmployeeProfileController::class, 'AddEditJob']);

        Route::get('/payment/mode', [EmployeeProfileController::class, 'getPaymentMode']);

        // Employee Dashboard
        Route::post('/employeeDashboard', [EmployeeDashboardController::class, 'storeAttendance']);
        Route::post('/employeeDashboard/attendance/request', [EmployeeDashboardController::class, 'requestAttendance']);
        Route::get('/employeeDashboard/list', [EmployeeDashboardController::class, 'listAttendances']);
        Route::get('/employeeDashboard/get-TodayActivity', [EmployeeDashboardController::class, 'fetchTodayActivities']);
        Route::get('/employeeDashboard/get-TimeSheet', [EmployeeDashboardController::class, 'fetchTimeSheetData']);
        Route::get('/employeeDashboard/get-progressData', [EmployeeDashboardController::class, 'fetchProgressData']);
        Route::get('/employeeDashboard/get-WorkingHoursData', [EmployeeDashboardController::class, 'fetchWorkingHoursData']);
        Route::get('/employeeDashboard/get-LeavesData', [EmployeeDashboardController::class, 'fetchLeavesData']);
        Route::get('/employeeDashboard/last-checkout-record', [EmployeeDashboardController::class, 'fetchLastCheckoutRecord']);
        Route::get('/employeeDashboard/get-upcomingHolidaysData', [EmployeeDashboardController::class, 'fetchUpcomingHolidaysData']);

        // Employee Attendance Request list
        Route::get('/employee/Attendance/request', [AdminAttendanceController::class, 'getAllAttendanceRequestByID']);
        Route::get('/employee/Attendance/request/delete/{id}', [AdminAttendanceController::class, 'deleteAttendanceRequestByID']);

        // Leaves
        Route::get('/Leave', [LeaveController::class, 'index']);
        Route::get('/Leave/type', [LeaveController::class, 'fetchAllLeaveType']);
        Route::post('/Leave/store', [LeaveController::class, 'store']);
        Route::get('/Leave/view', [LeaveController::class, 'view']);
        Route::post('/Leave/update', [LeaveController::class, 'update']);
        Route::post('/Leave/delete/{id}', [LeaveController::class, 'delete']);

        // Admin Leaves
        Route::get('/admin/leaves', [AdminLeaveController::class, 'index']);
        Route::get('/admin/leaves/headerData', [AdminLeaveController::class, 'headerData']);
        Route::post('/admin/Leave/update', [AdminLeaveController::class, 'update']);
        Route::post('/admin/leaves/request/delete/{id}', [AdminLeaveController::class, 'deleteLeaveRequest']);

        // leave Report
        Route::get('/leaves/report/get-data', [AdminLeaveController::class, 'getLeavesReportData']);
        Route::post('/leaves/report/update-data', [AdminLeaveController::class, 'updateLeavesReportData']);

        // Admin Leaves Type
        Route::get('/leaves/setting', [AdminLeaveController::class, 'leaveSetting']);
        Route::post('/admin/Leave/type/create', [AdminLeaveController::class, 'createLeaveType']);
        Route::get('/admin/Leave/type/view', [AdminLeaveController::class, 'viewLeaveType']);
        Route::post('/admin/Leave/type/update', [AdminLeaveController::class, 'updateLeaveType']);
        Route::post('/admin/Leave/type/delete/{id}', [AdminLeaveController::class, 'deleteLeaveType']);
        Route::get('/admin/getAllLeaveData', [AdminLeaveController::class, 'getAllLeaveData']);

        // Admin Attendance
        Route::get('/admin/Attendance', [AdminAttendanceController::class, 'index']);
        Route::get('/admin/AttendanceFilter', [AdminAttendanceController::class, 'filterAttendance']);
        Route::get('/admin/AllEmployees', [AdminAttendanceController::class, 'getAllEmployees']);
        Route::get('/admin/Attendance/request', [AdminAttendanceController::class, 'getAllAttendanceRequest']);
        Route::post('/admin/Attendance/request/update', [AdminAttendanceController::class, 'updateAttendanceRequest']);
        Route::get('/admin/Attendance/get-requestData', [AdminAttendanceController::class, 'getAttendanceRequest']);
        Route::post('/admin/attendance/request/delete/{id}', [AdminAttendanceController::class, 'deleteAttendanceRequest']);

        // Admin Holidays
        Route::get('/holidays', [HolidayController::class, 'index']);
        Route::post('/admin/holidays/create', [HolidayController::class, 'createHoliday']);
        Route::get('/admin/holidays/view', [HolidayController::class, 'viewHoliday']);
        Route::post('/admin/holidays/update', [HolidayController::class, 'updateHoliday']);
        Route::post('/admin/holidays/delete/{id}', [HolidayController::class, 'deleteHoliday']);

        // Admin Dashboard
        Route::get('/admin/dashboard/get-employee-department-count', [AdminDashboardController::class, 'getDepartmentEmployeeCount']);
        Route::get('/admin/dashboard/get-employee-attendance-overview', [AdminDashboardController::class, 'getEmployeeAttendanceOverview']);

        // SuperAdmin Dashboard
        Route::get('/super-admin/dashboard/company-status-overview', [superAdminDashboardController::class, 'getCompanyStatusOverview']);

        // Financial Year
        Route::get('/financial-year', [FinancialYearController::class, 'index']);
        Route::post('/financial-year/create', [FinancialYearController::class, 'createFinancialYear']);
        Route::get('/financial-year/view', [FinancialYearController::class, 'viewFinancialYear']);
        Route::post('/financial-year/update', [FinancialYearController::class, 'updateFinancialYear']);
        Route::post('/financial-year/delete/{id}', [FinancialYearController::class, 'deleteFinancialYear']);

        // Company
        Route::get('/company', [CompanyController::class, 'index']);
        Route::post('/company/create', [CompanyController::class, 'createCompany']);
        Route::get('/company/view', [CompanyController::class, 'viewCompany']);
        Route::post('/company/update', [CompanyController::class, 'updateCompany']);
        Route::post('/company/delete/{id}', [CompanyController::class, 'deleteCompany']);

        // Employee
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employee');

        // Allowance List
        Route::get('/allowance', [AllowanceListController::class, 'index']);
        Route::post('/allowance/create', [AllowanceListController::class, 'store']);
        Route::get('/allowance/view', [AllowanceListController::class, 'view']);
        Route::post('/allowance/update', [AllowanceListController::class, 'update']);
        Route::post('/allowance/delete/{id}', [AllowanceListController::class, 'delete']);

        // Deduction List
        Route::get('/deduction', [DeductionController::class, 'index']);
        Route::post('/deduction/create', [DeductionController::class, 'store']);
        Route::get('/deduction/view', [DeductionController::class, 'view']);
        Route::post('/deduction/update', [DeductionController::class, 'update']);
        Route::post('/deduction/delete/{id}', [DeductionController::class, 'delete']);

        // Employee Salary
        Route::get('/employee/salary', [EmployeeSalaryController::class, 'salaryIndex']);
        Route::post('/employee/salary/create', [EmployeeSalaryController::class, 'salaryStore']);
        Route::get('/employee/salary/view', [EmployeeSalaryController::class, 'salaryView']);
        Route::post('/employee/salary/update', [EmployeeSalaryController::class, 'salaryUpdate']);
        Route::post('/employee/salary/delete/{id}', [EmployeeSalaryController::class, 'salaryDelete']);
        Route::get('/employee/salary/download', [EmployeeSalaryController::class, 'downloadSalarySlip']);

        // Email Settings API Routes
        Route::get('/email-settings', [EmailSettingsController::class, 'index']);
        Route::post('/email-settings/create', [EmailSettingsController::class, 'store']);
        Route::get('/email-settings/view', [EmailSettingsController::class, 'view']);
        Route::post('/email-settings/update', [EmailSettingsController::class, 'update']);
        Route::post('/email-settings/delete/{id}', [EmailSettingsController::class, 'delete']);
        Route::post('/email-settings/test-connection', [EmailSettingsController::class, 'testConnection']);

        // Notification Settings API Routes
        Route::post('/notification-settings/update', [NotificationSettingController::class, 'update']);
        Route::get('/notification-settings', [NotificationSettingController::class, 'index']);
    });
});

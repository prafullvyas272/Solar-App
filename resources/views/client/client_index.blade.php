@extends('layouts.layout')
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="head-label text-center">
                    <h5 class="card-title mb-0"><b>{{ $menuName }}</b></h5>
                </div>
                @if ($permissions['canAdd'])
                    <button id="btnAdd" type="submit" class="btn btn-primary waves-effect waves-light"
                        onClick="fnAddEdit(this, '{{ url('/client/create') }}', 0, 'Add Solar Application',true)">
                        <span class="tf-icons mdi mdi-plus">&nbsp;</span>Add New Solar Application
                    </button>
                @endif
            </div>

            <div>
                <input type="hidden" id="disableAcceptButton" value="{{ $disableAcceptButton }}">
                <input type="hidden" id="disableClientPDFButton" value="{{ $disableClientPDFButton }}">
            </div>

            <!-- 🔍 Filters -->
            <div class="row p-3">
                <div class="col-md-3">
                    <label for="filterLoanStatus">Loan Status</label>
                    <select id="filterLoanStatus" class="form-control">
                        <option value="">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Sanctioned">Sanctioned</option>
                        <option value="Disbursed">Disbursed</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Approved">Approved</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="filterSubsidyStatus">Subsidy Status</label>
                    <select id="filterSubsidyStatus" class="form-control">
                        <option value="">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Received">Received</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="filterInstallationStatus">Installation Status</label>
                    <select id="filterInstallationStatus" class="form-control">
                        <option value="">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Installed">Installed</option>
                    </select>
                </div>

                {{-- Only for Admin / Superadmin --}}
                @if(in_array($roleCode, [config('roles.ADMIN'), config('roles.SUPERADMIN')]))
                    <div class="col-md-3">
                        <label for="filterInsertedBy">Inserted By</label>
                        <input type="text" id="filterInsertedBy" class="form-control" placeholder="Search Employee Name">
                    </div>
                @endif
            </div>

            <div class="card-datatable text-nowrap">
                <table id="grid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Form Download</th>
                            <th>System Entry Date</th>
                            <th>Customer Name</th>
                            <th>Consumer No</th>
                            <th>Solar Capacity</th>
                            <th>Mobile Number</th>
                            <th>Customer Email</th>
                            <th>Aadhar Linked Mobile Number</th>
                            <th>DISCOM Name</th>
                            <th>Channel Partner</th>
                            <th>Installation Team</th>
                            <th>Registrar</th>
                            <th>Inserted By</th> <!-- ✅ Added Inserted By column -->
                            <th>Quotation Amount</th>
                            <th>Is Completed</th>
                            <th>Installation Status</th>
                            <th>Loan Status</th>
                            <th>Subsidy Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            let table = initializeDataTable();

            // 🔍 Hook filters to DataTable columns
            $('#filterLoanStatus').on('change', function() {
                table.column(17).search(this.value).draw(); // Loan Status
            });

            $('#filterSubsidyStatus').on('change', function() {
                table.column(18).search(this.value).draw(); // Subsidy Status
            });

            $('#filterInstallationStatus').on('change', function() {
                table.column(16).search(this.value).draw(); // Installation Status
            });

            $('#filterInsertedBy').on('keyup change', function() {
                table.column(13).search(this.value).draw(); // Inserted By
            });
        });

        function initializeDataTable() {

            const disableAcceptButton = $("#disableAcceptButton").val();
            const disableClientPDFButton = $("#disableClientPDFButton").val();
            console.log(disableAcceptButton, disableClientPDFButton)
            return $("#grid").DataTable({
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Client Report',
                        className: 'buttons-excel d-none',
                        exportOptions: { columns: [1, 2, 3] }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Client Report',
                        className: 'buttons-csv d-none',
                        exportOptions: { columns: [1, 2, 3] }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Client Report',
                        className: 'buttons-pdf d-none',
                        exportOptions: { columns: [1, 2, 3] }
                    }
                ],
                responsive: true,
                autoWidth: false,
                serverSide: false,
                processing: true,
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "<img src='{{ asset('assets/img/illustrations/loader.gif') }}' alt='loader' />"
                },
                order: [[2, "desc"]], // Order by System Entry Date
                ajax: {
                    url: "{{ config('apiConstants.CLIENT_URLS.CLIENT') }}",
                    type: "GET",
                    headers: {
                        Authorization: "Bearer " + getCookie("access_token"),
                    },
                },
                columns: [
                    {
                        data: "id",
                        orderable: false,
                        render: function(data, type, row) {
                            var html = "<ul class='list-inline m-0'>";
                            // Edit button
                            html += "<li class='list-inline-item'>" +
                                GetEditDeleteButton({{ $permissions['canEdit'] }},
                                    "{{ url('/client/create') }}", "Edit",
                                    data, "Edit Solar Application", true) +
                                "</li>";
                            // Delete button
                            html += "<li class='list-inline-item'>" +
                                GetEditDeleteButton({{ $permissions['canDelete'] }},
                                    "fnShowConfirmDeleteDialog('" + row.customer_name +
                                    "',fnDeleteRecord," +
                                    data + ",'" +
                                    '{{ config('apiConstants.USER_API_URLS.USER_DELETE') }}' +
                                    "','#grid')", "Delete") +
                                "</li>";
                            // Eye icon for view details
                            html += "<li class='list-inline-item'>" +
                                "<a href='{{ url('/client/details') }}/" + data + "' " +
                                "class='btn btn-sm btn-info' title='View Details'>" +
                                "<i class='mdi mdi-eye'></i></a>" +
                                "</li>";

                            html += "<li class='list-inline-item'>" +
                                "<a href='{{ url('/customer-history') }}/" + data + "' " +
                                "class='btn btn-sm btn-warning' title='View History'>" +
                                "<i class='mdi mdi-history'></i></a>" +
                                "</li>";
                            // Accept button
                            let disableAttribute = disableAcceptButton ? 'disabled' : '';
                            html += "<li class='list-inline-item'>" +
                                "<button type='button' onclick='acceptcustomer(" + data +
                                ")' class='btn btn-sm btn-success' title='Accept' " + disableAttribute + ">" +
                                "<i class='mdi mdi-check-circle'></i></button>" +
                                "</li>";
                            html += "</ul>";
                            return html;
                        },
                    },
                    {
                        data: "id",
                        orderable: false,
                        render: function(data, type, row) {
                            var html = "<ul class='list-inline m-0'>";
                            html += "<li class='list-inline-item'>" +
                                "<button class='btn btn-sm btn-text-info rounded btn-icon item-edit' " +
                                "style='background-color: #c7e9ff !important; color:#009dff !important;' title='Download Consumer Agreement' " +
                                "onClick=\"downloadSalarySlip(" + data + ")\">" +
                                "<i class='mdi mdi-file-download-outline'></i></button>" +
                                "</li>";
                            html += "<li class='list-inline-item'>" +
                                "<button class='btn btn-sm btn-text-info rounded btn-icon item-edit' " +
                                "style='background-color: #e0ffd6 !important; color:#28a745 !important;' title='Download PCR' " +
                                "onClick=\"downloadPCR(" + data + ")\">" +
                                "<i class='mdi mdi-file-download-outline'></i></button>" +
                                "</li>";
                            html += "<li class='list-inline-item'>" +
                                "<button class='btn btn-sm btn-text-info rounded btn-icon item-edit' " +
                                "style='background-color: #fff7d6 !important; color:#ffb300 !important;' title='Download Provisional Agreement' " +
                                "onClick=\"downloadProvisionalAgreement(" + data + ")\">" +
                                "<i class='mdi mdi-file-download-outline'></i></button>" +
                                "</li>";
                            html += "<li class='list-inline-item'>" +
                                "<button class='btn btn-sm btn-text-info rounded btn-icon item-edit' " +
                                "style='background-color: #ffe4ec !important; color:#e75480 !important;' title='Download UGVCL' " +
                                "onClick=\"downloadUGVCLReport(" + data + ")\">" +
                                "<i class='mdi mdi-file-download-outline'></i></button>" +
                                "</li>";
                            let disableClientPDFBtn = disableClientPDFButton ? 'disabled' : '';
                            html += "<li class='list-inline-item'>" +
                                "<button class='btn btn-sm btn-text-info rounded btn-icon item-edit' " +
                                "style='background-color: #f8f9fa !important; color:#e75480 !important;' title='Download Client Details' " +
                                "onClick=\"downloadClientDetailsPDF(" + data + ")\" " + disableClientPDFBtn + ">" +
                                "<i class='mdi mdi-file-download-outline'></i></button>" +
                                "</li>";


                            let disableCashReceiptBtn = (row.margin_money_status === 'Pending') ? 'disabled' : '';
                            html += "<li class='list-inline-item'>" +
                                "<button class='btn btn-sm btn-text-info rounded btn-icon item-edit' " +
                                "style='background-color: #e9f7ef !important; color:#28a745 !important;' title='Download Cash Receipt' " +
                                "onClick=\"downloadCashReceipt(" + data + ")\" " + disableCashReceiptBtn + ">" +
                                "<i class='mdi mdi-cash'></i></button>" +
                                "</li>";

                            html += "</ul>";
                            return html;
                        },
                    },
                    { data: "created_at" },         // index 2
                    { data: "customer_name" },      // index 3
                    {
                        data: "customer_number",     // index 4
                        render: function(data, type, row) {
                            if ({{ $permissions['canEdit'] }}) {
                                return `<a href="{{ url('/client/details') }}/${row.id}"
                                    class="text-primary">${data}</a>`;
                            }
                            return data;
                        }
                    },
                    { data: "capacity" },           // index 5
                    { data: "alternate_mobile" },   // index 6
                    { data: "email" },              // index 7
                    { data: "mobile" },             // index 8
                    { data: "solar_company" },      // index 9
                    { data: "channel_partner_name" }, // index 10
                    { data: "installer_name" },     // index 11
                    { data: "assign_to_name" },     // index 12 (Registrar)
                    { data: "inserted_by_name" },   // ✅ index 13 (Inserted By)
                    { data: "amount" },             // index 14
                    {
                        data: "is_completed",
                        render: function(data) {
                            return data === 1 ?
                                `<span class="badge rounded bg-label-success">Completed</span>` :
                                `<span class="badge rounded bg-label-danger">Pending</span>`;
                        }
                    },                              // index 15
                    { data: 'installation_status' }, // index 16
                    { data: 'loan_status' },         // index 17
                    { data: 'subsidy_status' },      // index 18
                ]
            });
        }

        // ✅ Accept / Download functions remain same
        function acceptcustomer(id) {
            var Url = "{{ config('apiConstants.CLIENT_URLS.CLIENT_ACCEPT') }}";
            var postData = { id: id };
            fnCallAjaxHttpPostEvent(Url, postData, true, true, function(response) {
                if (response.status === 200) {
                    $('#grid').DataTable().ajax.reload();
                    ShowMsg("bg-success", response.message);
                } else {
                    ShowMsg("bg-warning", 'The record could not be processed.');
                }
            });
        }

        function downloadSalarySlip(id) {
            let url = `${window.location.origin}/api/V1/download-annexure2`;
            fnCallAjaxHttpGetEvent(url, { id }, true, true, function(response) {
                if (response.status === 200 && response.data) {
                    window.open(response.data, '_blank');
                }
            });
        }

        function downloadPCR(id) {
            let url = `${window.location.origin}/api/V1/download-pcr`;
            fnCallAjaxHttpGetEvent(url, { id }, true, true, function(response) {
                if (response.status === 200 && response.data) {
                    window.open(response.data, '_blank');
                } else {
                    ShowMsg("bg-warning", 'Failed to download PCR.');
                }
            });
        }

        function downloadProvisionalAgreement(id) {
            let url = `${window.location.origin}/api/V1/download-provisional-agreement`;
            fnCallAjaxHttpGetEvent(url, { id }, true, true, function(response) {
                if (response.status === 200 && response.data) {
                    window.open(response.data, '_blank');
                } else {
                    ShowMsg("bg-warning", 'Failed to download Provisional Agreement.');
                }
            });
        }

        function downloadUGVCLReport(id) {
            let url = `${window.location.origin}/api/V1/download-ugvcl-report`;
            fnCallAjaxHttpGetEvent(url, { id }, true, true, function(response) {
                if (response.status === 200 && response.data) {
                    window.open(response.data, '_blank');
                } else {
                    ShowMsg("bg-warning", 'Failed to download Provisional Agreement.');
                }
            });
        }

        function downloadClientDetailsPDF(id) {
            let url = `${window.location.origin}/api/V1/download-client-details`;
            fnCallAjaxHttpGetEvent(url, { id }, true, true, function(response) {
                if (response.status === 200 && response.data) {
                    window.open(response.data, '_blank');
                } else {
                    ShowMsg("bg-warning", 'Failed to download Client Details.');
                }
            });
        }

    function downloadCashReceipt(id) {
        let url = `${window.location.origin}/api/V1/download-cash-receipt`;
        fnCallAjaxHttpGetEvent(url, { id }, true, true, function(response) {
            if (response.status === 200 && response.data) {
                window.open(response.data, '_blank');
            } else {
                ShowMsg("bg-warning", 'Failed to download Cash Receipt.');
            }
        });
    }

    </script>
@endsection

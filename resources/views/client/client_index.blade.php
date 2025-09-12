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
                        <span class="tf-icons mdi mdi-plus">&nbsp;</span>Adds New Solar Application
                    </button>
                @endif
            </div>

            <!-- 🔍 Filters -->
            <div class="row p-3">
                <div class="col-md-3">
                    <label for="filterCapacity">Solar Capacity</label>
                    <input type="text" id="filterCapacity" class="form-control" placeholder="Search Capacity">
                </div>
                <div class="col-md-3">
                    <label for="filterConsumer">Consumer No</label>
                    <input type="text" id="filterConsumer" class="form-control" placeholder="Search Consumer No">
                </div>
                <div class="col-md-3">
                    <label for="filterDate">System Entry Date</label>
                    <input type="date" id="filterDate" class="form-control">
                </div>
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
                            <th>Quotation Amount</th>
                            <th>Is Completed</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            initializeDataTable();

            // 🔍 Hook filters to DataTable columns
            $('#filterCapacity').on('keyup change', function() {
                $('#grid').DataTable().column(5).search(this.value).draw();
            });

            $('#filterConsumer').on('keyup change', function() {
                $('#grid').DataTable().column(4).search(this.value).draw();
            });

            $('#filterDate').on('change', function() {
                $('#grid').DataTable().column(2).search(this.value).draw();
            });
        });

        function initializeDataTable() {
            $("#grid").DataTable({
                buttons: [{
                        extend: 'excelHtml5',
                        title: 'Client Report',
                        className: 'buttons-excel d-none',
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        title: 'Client Report',
                        className: 'buttons-csv d-none',
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Client Report',
                        className: 'buttons-pdf d-none',
                        exportOptions: {
                            columns: [1, 2, 3]
                        }
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
                order: [
                    [1, "asc"]
                ],
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
                            html += "<li class='list-inline-item'>" +
                                GetEditDeleteButton({{ $permissions['canEdit'] }},
                                    "{{ url('/client/create') }}", "Edit",
                                    data, "Edit Solar Application", true) +
                                "</li>";
                            html += "<li class='list-inline-item'>" +
                                GetEditDeleteButton({{ $permissions['canDelete'] }},
                                    "fnShowConfirmDeleteDialog('" + row.customer_name +
                                    "',fnDeleteRecord," +
                                    data + ",'" +
                                    '{{ config('apiConstants.USER_API_URLS.USER_DELETE') }}' +
                                    "','#grid')", "Delete") +
                                "</li>";
                            html += "<li class='list-inline-item'>" +
                                "<button type='button' onclick='acceptcustomer(" + data +
                                ")' class='btn btn-sm btn-success' title='Accept'>" +
                                "<i class='mdi mdi-check-circle'></i></button>" +
                                "</li>";
                            html += "</ul>";
                            return html;
                        },
                    },
                    {
                        data: "id",
                        orderable: false,
                        render: function(data) {
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
                            html += "</ul>";
                            return html;
                        },
                    },
                    { data: "created_at" },       // index 2
                    { data: "customer_name" },   // index 3
                    {
                        data: "customer_number", // index 4 (Consumer No)
                        render: function(data, type, row) {
                            if ({{ $permissions['canEdit'] }}) {
                                return `<a href="{{ url('/client/details') }}/${row.id}"
                                    class="text-primary">${data}</a>`;
                            }
                            return data;
                        }
                    },
                    { data: "capacity" },         // index 5 (Solar Capacity)
                    { data: "alternate_mobile" },
                    { data: "email" },
                    { data: "mobile" },
                    { data: "solar_company" },
                    { data: "channel_partner_name" },
                    { data: "installer_name" },
                    { data: "assign_to_name" },
                    { data: "amount" },
                    {
                        data: "is_completed",
                        render: function(data) {
                            return data === 1 ?
                                `<span class="badge rounded bg-label-success">Completed</span>` :
                                `<span class="badge rounded bg-label-danger">Pending</span>`;
                        }
                    }
                ]
            });
        }

        // ✅ Accept / Download functions (unchanged)
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
    </script>
@endsection

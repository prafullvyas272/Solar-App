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
                        onClick="fnAddEdit(this, '{{ url('/quotation/create') }}', 0, 'Add Quotation',true)">
                        <span class="tf-icons mdi mdi-plus">&nbsp;</span>Add Quotation
                    </button>
                @endif
            </div>
            <hr class="my-0">

            <!-- 🔍 Filters -->
            <div class="row p-3">
                <div class="col-md-3">
                    <label for="filterCustomer">Customer Name</label>
                    <input type="text" id="filterCustomer" class="form-control" placeholder="Search Customer">
                </div>

                <div class="col-md-3">
                    <label for="filterStatus">Status</label>
                    <select id="filterStatus" class="form-control">
                        <option value="">All</option>
                        <option value="Agreed">Agreed</option>
                        <option value="Pending">Pending</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="filterDate">Quotation Date</label>
                    <input type="date" id="filterDate" class="form-control">
                </div>
            </div>

            <div class="card-datatable text-nowrap">
                <table id="grid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Customer Name</th>
                            <th>Quotation Amount</th>
                            <th>Quotation By</th>
                            <th>Quotation Date</th>
                            <th>Required</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            initializeDataTable();

            // 🔍 Hook filters
            $('#filterCustomer').on('keyup change', function() {
                $('#grid').DataTable().column(1).search(this.value).draw();
            });

            $('#filterStatus').on('change', function() {
                $('#grid').DataTable().column(6).search(this.value).draw();
            });

            $('#filterDate').on('change', function() {
                $('#grid').DataTable().column(4).search(this.value).draw();
            });
        });

        function initializeDataTable() {
            var table = $("#grid").DataTable({
                responsive: true,
                autoWidth: false,
                serverSide: false,
                processing: true,
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "<img src='{{ asset('assets/img/illustrations/loader.gif') }}' alt='loader' />"
                },
                order: [
                    [1, "desc"]
                ],
                ajax: {
                    url: "{{ config('apiConstants.QUOTATION_URLS.QUOTATION') }}",
                    type: "GET",
                    headers: {
                        Authorization: "Bearer " + getCookie("access_token"),
                    },
                },
                columns: [{
                        data: "id",
                        orderable: false,
                        render: function(data, type, row) {
                            var html = "<ul class='list-inline m-0'>";

                            html += "<li class='list-inline-item'>" +
                                GetEditDeleteButton({{ $permissions['canEdit'] }},
                                    "{{ url('quotation/create') }}", "Edit",
                                    data, "Edit Quotation", 'true') +
                                "</li>";

                            html += "<li class='list-inline-item'>" +
                                GetEditDeleteButton({{ $permissions['canDelete'] }},
                                    "fnShowConfirmDeleteDialog('" + row.customer_name +
                                    "',fnDeleteRecord," +
                                    data + ",'" +
                                    '{{ config('apiConstants.QUOTATION_URLS.QUOTATION_DELETE') }}' +
                                    "','#grid')", "Delete") +
                                "</li>";

                            html += "<li class='list-inline-item'>" +
                                GetEditDeleteButton(true,
                                    "{{ url('quotation/download') }}", "Download",
                                    data, "Download Quotation", 'true') +
                                "</li>";

                            html += "</ul>";
                            return html;
                        },
                    },
                    {
                        data: "customer_name",
                    },
                    {
                        data: "amount",
                    },
                    {
                        data: "prepared_by",
                    },
                    {
                        data: "date",
                    },
                    {
                        data: "required",
                    },
                    {
                        data: "status",
                        render: function(data) {
                            return data === "Agreed" ?
                                `<span class="badge rounded bg-label-success">Agreed</span>` :
                                `<span class="badge rounded bg-label-danger">Pending</span>`;
                        }
                    },
                ]
            });
        }
    </script>
@endsection

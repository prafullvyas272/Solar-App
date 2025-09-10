@extends('layouts.layout')
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="head-label text-center">
                    <h5 class="card-title mb-0"><b>Document List</b></h5>
                </div>
            </div>
            <hr class="my-0">
            <div class="card-datatable text-nowrap">
                <table id="grid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Document Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            initializeDataTable();
        });

        function initializeDataTable() {
            $("#grid").DataTable({
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
                    url: "{{ config('apiConstants.PROPOSAL_URLS.PROPOSAL_DOCUMENTS_LIST') }}",
                    type: "GET",
                    headers: {
                        Authorization: "Bearer " + getCookie("access_token"),
                    },
                },
                columns: [{
                        data: "file_display_name",
                    },
                    {
                        data: "id",
                        orderable: false,
                        render: function(data, type, row) {
                            var html = "<ul class='list-inline m-0'>";

                            // Download Button
                            html += "<li class='list-inline-item'>" +
                                "<button class='btn btn-sm btn-text-info rounded btn-icon item-edit' " +
                                "style='background-color: #c7e9ff !important; color:#009dff !important;' title='Download Document' " +
                                "onClick=\"downloadDocument(" + data + ")\">" +
                                "<i class='mdi mdi-file-download-outline'></i></button>" +
                                "</li>";

                            html += "</ul>";
                            return html;
                        },
                    }
                ]
            });
        }

        function downloadDocument(id) {
            let url = `{{ config('apiConstants.PROPOSAL_URLS.PROPOSAL_DOWNLOAD_DOCUMENT') }}`;
            fnCallAjaxHttpGetEvent(url, {
                id: id
            }, true, true, function(response) {
                if (response.status === 200 && response.data) {
                    window.open(response.data, '_blank');
                }
            });
        }
    </script>
@endsection

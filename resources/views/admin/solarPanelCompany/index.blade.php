@extends('layouts.layout')
@section('content')
    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="head-label text-center">
                    <h5 class="card-title mb-0"><b>Solar Panel Companies</b></h5>
                </div>
                <button id="btnAdd" type="submit" class="btn btn-primary waves-effect waves-light"
                        onClick="fnAddEdit(this, '{{ url('solar-panel-company/create') }}', 0, 'Add Solar Company')">
                        <span class="tf-icons mdi mdi-plus">&nbsp;</span>Add Solar Company
                </button>
            </div>
            <hr class="my-0">
            <div class="card-datatable text-nowrap">
                <table id="solarCompanyGrid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <button id="btnEdit" type="submit" class="btn btn-sm btn-primary waves-effect waves-light"
                                                    onClick="fnAddEdit(this, '{{ url('solar-panel-company/create') }}', {{ $company->id }}, 'Edit Solar Company')">
                                                    <i class="mdi mdi-pencil"></i>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <form action="{{ route('solar-panel-company.destroy', $company->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this company?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                                <td>{{ $company->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#solarCompanyGrid').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "<img src='{{ asset('assets/img/illustrations/loader.gif') }}' alt='loader' />"
                },
                order: [
                    [1, "desc"]
                ],

            });
        });
    </script>
@endsection

@extends('layouts.layout')
@section('content')


    <div class="container-fluid flex-grow-1 container-p-y">
        <div class="card">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-5" style="margin-top: 25px;" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="head-label text-center">
                    <h5 class="card-title mb-0"><b>Stock Purchases</b></h5>
                </div>
                <button id="btnAdd" type="submit" class="btn btn-primary waves-effect waves-light"
                        onClick="fnAddEdit(this, '{{ url('stock-purchase/create') }}', 0, 'Add Stock Purchase')">
                        <span class="tf-icons mdi mdi-plus">&nbsp;</span>Add Stock Purchase
                </button>
            </div>
            <hr class="my-0">
            <div class="card-datatable text-nowrap">
                <table id="stockPurchaseGrid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Supplier Name</th>
                            <th>Purchase Invoice No</th>
                            <th>Invoice Date</th>
                            <th>Product Category</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Capacity</th>
                            <th>Quantity</th>
                            {{-- <th>Purchase Price</th> --}}
                            {{-- <th>GST</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stockPurchases ?? [] as $stockPurchase)
                            <tr>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item" title="Download Supplier Invoice">
                                            {{-- <a href="{{ route('stock-purchase.download-invoice', $stockPurchase->id ?? 0) }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Supplier Invoice">
                                                <i class="mdi mdi-download"></i>
                                            </a> --}}
                                        </li>
                                        <li class="list-inline-item" title="View Serial Numbers">
                                            {{-- <a href="{{ route('stock-purchase.serial-numbers', $stockPurchase->id ?? 0) }}" class="btn btn-sm btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="View Serial Numbers">
                                                <i class="mdi mdi-format-list-numbers"></i>
                                            </a> --}}
                                        </li>
                                        <li class="list-inline-item">
                                            <button id="btnEdit" type="submit" class="btn btn-sm btn-primary waves-effect waves-light"
                                                    onClick="fnAddEdit(this, '{{ url('stock-purchase/create') }}', {{ $stockPurchase->id }}, 'Edit Stock Purchase')">
                                                    <i class="mdi mdi-pencil"></i>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <form action="{{ route('stock-purchase.destroy', $stockPurchase->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this stock purchase?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                                <td>{{ $stockPurchase->supplier_name ?? '' }}</td>
                                <td>{{ $stockPurchase->purchase_invoice_no ?? '' }}</td>
                                <td>{{ $stockPurchase->invoice_date ?? '' }}</td>
                                <td>{{ $stockPurchase->productCategory->name ?? '' }}</td>
                                <td>{{ $stockPurchase->brand ?? '' }}</td>
                                <td>{{ $stockPurchase->model ?? '' }}</td>
                                <td>{{ $stockPurchase->capacity ?? '' }}</td>
                                <td>{{ $stockPurchase->quantity ?? '' }}</td>
                                {{-- <td>{{ $stockPurchase->purchase_price ?? '' }}</td> --}}
                                {{-- <td>{{ $stockPurchase->gst ?? '' }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#stockPurchaseGrid').DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                'language': {
                    "loadingRecords": "&nbsp;",
                    "processing": "<img src='{{ asset('assets/img/illustrations/loader.gif') }}' alt='loader' />"
                },
                order: [
                    [3, "desc"]
                ],
            });
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

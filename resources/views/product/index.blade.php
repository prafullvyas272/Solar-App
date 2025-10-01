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
                    <h5 class="card-title mb-0"><b>Product Serial Numbers</b></h5>
                </div>
                <button id="btnAdd" type="button" class="btn btn-primary waves-effect waves-light"
                        onClick="fnAddEdit(this, '{{ route('stock-purchase-products-create', ['stockPurchase' => $stockPurchaseId ?? 0]) }}', 0, 'Add Product Serial Number')">
                        <span class="tf-icons mdi mdi-plus">&nbsp;</span>Add Product Serial Number
                </button>
            </div>
            <hr class="my-0">
            <div class="card-datatable text-nowrap">
                <table id="productSerialGrid" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Serial Number</th>
                            <th>Category</th>
                            <th>Assigned To</th>        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <button id="btnEdit" type="button" class="btn btn-sm btn-primary waves-effect waves-light"
                                                onClick="fnAddEdit(this, '{{ route('stock-purchase-products-create', ['stockPurchase' => $product->stock_purchase_id]) }}?id={{ $product->id }}', '{{ $product->id }}', 'Edit Product Serial Number')">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                        </li>
                                        <li class="list-inline-item">
                                            <form action="{{ route('stock-purchase-products-destroy', [ $product->stock_purchase_id ,$product->id]) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this product serial number?')">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                                <td>{{ $product->serial_number }}</td>
                                <td>{{ $product->productCategory->name }}</td>
                                <td>{{ ($product->assignedTo) ? $product->assignedTo->first_name . ' ' . $product->assignedTo->last_name : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#productSerialGrid').DataTable({
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

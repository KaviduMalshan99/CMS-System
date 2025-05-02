@extends('AdminDashboard.master')
@section('title', 'quotation Managment')



@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>quotation Managment</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">quotation </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            <div class="col-md-8 mb-4">
                                <h3>quotation Managment List</h3>
                            </div>
                          
                            <div class="col-md-4 mb-4"><a href="{{ route('quotations.create') }}" class="btn btn-primary mb-3">Create New Quotation</a></div>
                            
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Quotation ID</th>
                                        <th>Customer Number</th>
                                        <th>Quotation Date</th>
                                        <th>Validity Period (Days)</th>
                                        <th>Items</th>
                                        <th>Total Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quotations as $quotation)
                                        <tr>
                                            <td>{{ $loop->iteration + ($quotations->currentPage() - 1) * $quotations->perPage() }}</td>
                                            <td>{{ $quotation->quotation_id }}</td>
                                            <td>{{ $quotation->customer_nic }}</td>
                                            <td>{{ $quotation->quotation_date }}</td>
                                            <td>{{ $quotation->quotation_validity }}</td>
                                            <td>
                                                @php
                                                    $items = is_string($quotation->quotation_items) ? json_decode($quotation->quotation_items, true) : $quotation->quotation_items;
                                                @endphp
                                            
                                                @if(is_array($items) && count($items) > 0)
                                                    <table class="table table-sm table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Item Name</th>
                                                                <th>Quantity</th>
                                                                <th>Discount (LKR)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($items as $item)
                                                                <tr>
                                                                    <td>{{ $item['name'] ?? 'N/A' }}</td>
                                                                    <td>{{ $item['quantity'] ?? 0 }}</td>
                                                                    <td>{{ number_format($item['discount_lkr'] ?? 0, 2) }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    No Items
                                                @endif
                                            </td>
                                            <td>{{ number_format($quotation->due_amount, 2) }}</td>
                                            <td>
                                                <div class="d-flex ">
                                                    <!-- Delete Form -->
                                                    <form action="{{ route('quotations.destroy', $quotation->quotation_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this quotation?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mr-2">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                            
                                                    <!-- Invoice Button -->
                                                    <a href="{{ route('quotations.bill', $quotation->id) }}" class="btn btn-warning btn-sm mx-2">
                                                        <i class="fa fa-file"></i> Invoice
                                                    </a>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-3 d-flex justify-content-center">
                                <nav>
                                    <ul class="pagination">
                                        {{ $quotations->links('pagination::bootstrap-4') }}
                                    </ul>
                                </nav>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#keytable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "responsive": true,
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "search": "Search records:",
                    "lengthMenu": "Display _MENU_ records per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "infoEmpty": "No records available",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                  
                    "zeroRecords": "No matching records found"
                }
            });
        });
    </script>
@endsection






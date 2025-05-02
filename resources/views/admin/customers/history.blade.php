@extends('AdminDashboard.master')
@section('title', 'Battery Orders')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('style')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Orders</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row gx-3">
                            <div class="col-md-8 mb-4">
                                <h3>Order List</h3>
                            </div>
                            <div class="col-md-4">
                                <!-- Customer Select Dropdown -->
                                <select class="form-select f-w-400 f-14 text-gray py-2" aria-label="Select Customer"
                                    id="customer-select" required>
                                    <option value="" selected disabled>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->phone_number }} - {{ $customer->first_name }}
                                            {{ $customer->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="dt-ext table-responsive">
                            <table class="display" id="keytable">
                                <thead>
                                    <tr class="border-bottom-primary">
                                        <th>ID</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Phone</th>
                                        <th>Order Type</th>
                                        <th>Total Price</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th>Prepared By</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($batteryOrders as $order)
                                        <tr id="customer-{{ $order->customer->id }}">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                                            <td>{{ $order->customer->phone_number }}</td>
                                            <td>{{ $order->order_type }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->due_amount }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3 ">
                                                        <a href="{{ route('POS.bill', ['id' => $order->id, 'companyId' => $companyDetails['id']]) }}"
                                                            class="btn btn-warning btn-sm">Invoice</a>
                                                    </div>
                                                    @if ($order->tax_invoice_id)
                                                        <div class="col-6 ">
                                                            <a href="{{ route('POS.taxInvoice', ['id' => $order->id, 'companyId' => $companyDetails['id']]) }}"
                                                                class="btn btn-success btn-sm">Tax Invoice</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                    @forelse($lubricantOrders as $order)
                                        <tr id="customer-{{ $order->customer_id }}">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                            <td>{{ $order->phone_number }}</td>
                                            <td>{{ $order->order_type }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->due_amount }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td>
                                                @if ($order->payment_status === 'Pending')
                                                    Not Completed
                                                @else
                                                    {{ $order->payment_status }}
                                                @endif
                                            </td>
                                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <a href="{{ route('POS.lubricant_bill', ['id' => $order->id]) }}"
                                                            class="btn btn-warning btn-sm">Invoice</a>
                                                    </div>
                                                    @if ($order->tax_invoice_id)
                                                        <div class="col-6 ">
                                                            <a href="{{ route('POS.lubricant_tax_invoice', ['id' => $order->id]) }}"
                                                                class="btn btn-success btn-sm">Tax Invoice</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="my-2">
                                            <td colspan="12" class="text-center">No Orders Available</td>
                                        </tr>
                                    @endforelse

                                    @forelse($rentalDetails as $order)
                                        <tr id="customer-{{ $order->customer->id }}">
                                            <td>{{ $order->id }}</td>
                                            <td>Rental{{ $order->id }}</td>
                                            <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                                            <td>{{ $order->customer->phone_number }}</td>
                                            <td>Rental</td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->due_amount }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td>
                                                @if ($order->payment_status === 'Pending')
                                                    Not Completed
                                                @else
                                                    {{ $order->payment_status }}
                                                @endif
                                            </td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <a href="{{ route('rentals.bill', ['rental' => $order->id]) }}"
                                                            class="btn btn-warning btn-sm">Invoice</a>
                                                    </div>
                                                    @if ($order->tax_invoice_id)
                                                        <div class="col-6 ">
                                                            <a href="{{ route('rentals.taxInvoice', ['rental' => $order->id]) }}"
                                                                class="btn btn-success btn-sm">Tax Invoice</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                    @forelse($repairDetails as $order)
                                        <tr id="customer-{{ $order->customer->id }}">
                                            <td>{{ $order->id }}</td>
                                            <td>Repair{{ $order->id }}</td>
                                            <td>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</td>
                                            <td>{{ $order->customer->phone_number }}</td>
                                            <td>Repair</td>
                                            <td>{{ $order->total_cost }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->due_amount }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td>
                                                @if ($order->payment_status === 'Pending')
                                                    Not Completed
                                                @else
                                                    {{ $order->payment_status }}
                                                @endif
                                            </td>
                                            <td>{{ $order->user->name }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <a href="{{ route('repairs.bill', ['repair' => $order->id]) }}"
                                                            class="btn btn-warning btn-sm">Invoice</a>
                                                    </div>
                                                    @if ($order->tax_invoice_id)
                                                        <div class="col-6 ">
                                                            <a href="{{ route('repairs.taxInvoice', ['repair' => $order->id]) }}"
                                                                class="btn btn-success btn-sm">Tax Invoice</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var table = $('#keytable').DataTable({
                "paging": true, // Enable pagination
                "searching": true, // Enable search box
                "ordering": true, // Enable sorting
                "responsive": true, // Enable responsive design for mobile devices
                "lengthChange": true, // Allow changing the number of rows displayed
                "pageLength": 10, // Set default page length to 10 rows
                "language": {
                    "search": "Search records:", // Customize search label
                    "lengthMenu": "Display _MENU_ records per page", // Customize per-page dropdown
                    "info": "Showing _START_ to _END_ of _TOTAL_ records", // Customize record information
                    "infoEmpty": "No records available", // Message when no data is available
                    "infoFiltered": "(filtered from _MAX_ total records)", // Message for filtered records
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "zeroRecords": "No matching records found" // Message when no search results
                }
            });

            // Handle the customer selection change
            $('#customer-select').on('change', function() {
                var selectedCustomerId = $(this).val();

                // Hide all rows
                $('#keytable tbody tr').hide();

                // Show rows with the selected customer ID
                $('#keytable tbody tr[id="customer-' + selectedCustomerId + '"]').show();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#customer-select').select2({
                placeholder: "Select Customer",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endsection

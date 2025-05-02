@extends('AdminDashboard.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@endsection

@section('breadcrumb-title')
    <h3>Income Report</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Income Report</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="startDate">Start Date:</label>
                                <input type="text" id="startDate" class="form-control datepicker"
                                    placeholder="Select Start Date">
                            </div>
                            <div class="col-md-4">
                                <label for="endDate">End Date:</label>
                                <input type="text" id="endDate" class="form-control datepicker"
                                    placeholder="Select End Date">
                            </div>
                            <div class="col-md-4 mt-4">
                                <button id="filterBtn" class="btn btn-primary">Filter</button>
                                <button id="resetBtn" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="dt-ext table-responsive">
                            <table class="display" id="tableData">
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Order Type</th>
                                        <th>Battery Or Lubricant Discount</th>
                                        <th>Old Battery Discount</th>
                                        <th>Sub Total</th>
                                        <th>Total Amount</th>
                                        <th>Paid Amount</th>
                                        <th>Due Amount</th>
                                        <th>Payment Type</th>
                                        <th>Order Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($battery_orders as $order)
                                        <tr>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->order_type }}</td>
                                            <td>{{ $order->battery_discount ?? number_format(0, 2) }}</td>
                                            <td>{{ $order->old_battery_discount_value ?? number_format(0, 2) }}</td>
                                            <td>{{ $order->subtotal }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->due_amount }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td>{{ $order->order_date }}</td>

                                        </tr>
                                    @empty
                                    @endforelse

                                    @forelse ($lubricant_orders as $order)
                                        <tr>
                                            <td>{{ $order->order_id }}</td>
                                            <td>Lubricant {{ $order->order_type }}</td>
                                            <td>{{ $order->lubricant_discount ?? number_format(0, 2) }}</td>
                                            <td>{{ $order->old_battery_discount ?? number_format(0, 2) }}</td>
                                            <td>{{ $order->subtotal }}</td>
                                            <td>{{ $order->total_price }}</td>
                                            <td>{{ $order->paid_amount }}</td>
                                            <td>{{ $order->due_amount }}</td>
                                            <td>{{ $order->payment_type }}</td>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>

                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                                {{-- <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-right">Totals</th>
                                        <th id="totalDiscount">0.00</th>
                                        <th colspan="1"></th>
                                        <th id="totalSubTotal">0.00</th>
                                        <th id="totalAmount">0.00</th>
                                        <th colspan="4"></th>
                                    </tr>
                                </tfoot> --}}

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#tableData').DataTable({
                dom: 'Bfrtip', // Layout for DataTables with Buttons
                buttons: [{
                        extend: 'copyHtml5',
                        footer: true
                    },
                    {
                        extend: 'excelHtml5',
                        footer: true
                    },
                    {
                        extend: 'csvHtml5',
                        footer: true
                    },
                    {
                        extend: 'pdfHtml5',
                        footer: true,
                        title: 'Income Report',
                        rientation: 'landscape',
                        customize: function(doc) {
                            // Set a margin for the footer
                            doc.content[1].margin = [0, 0, 0, 20];
                        }
                    },
                    {
                        extend: 'print',
                        footer: true,
                        title: 'Income Report',
                    }
                ],

            });

            // Initialize jQuery UI Datepicker
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd', // Format matches your database format
                changeMonth: true,
                changeYear: true
            });

            // Filter Function
            $('#filterBtn').click(function() {
                var startDate = $('#startDate').val();
                var endDate = $('#endDate').val();

                if (startDate !== '' && endDate !== '') {
                    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                        var orderDate = data[9]; // Order Date column (adjust index if needed)

                        if (orderDate >= startDate && orderDate <= endDate) {
                            return true;
                        }
                        return false;
                    });
                }
                table.draw();
                $.fn.dataTable.ext.search.pop();
            });

            // Reset Filter
            $('#resetBtn').click(function() {
                $('#startDate').val('');
                $('#endDate').val('');
                $.fn.dataTable.ext.search.pop();
                table.draw();
            });

        });
    </script>
@endsection

@section('script')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatable-extension/custom.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



@endsection

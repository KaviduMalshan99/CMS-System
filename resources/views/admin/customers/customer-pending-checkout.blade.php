@extends('AdminDashboard.master')
@section('title', 'Autofill Datatables')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatable-extension.css') }}">

@endsection

@section('breadcrumb-title')
    <h3>Customer Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Customer Pending Order List</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">

                    </div>
                    <div class="card-body">

                        <div class="row gx-3">
                            <div class="col-md-10 mb-4">
                                <h3>Customer Pending Order List</h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xxl-9 col-xl-8">
                                <div class="dt-ext table-responsive">
                                    <table class="display" id="keytable">
                                        <thead>
                                            <tr>
                                                <th><button type="button"
                                                        class="btn btn-success btn-sm btn-success mb-0">All</button></th>

                                                <th>Order Id</th>
                                                <th>Order Type</th>
                                                <th>Discount</th>
                                                <th>Old Battery Discount</th>
                                                <th>Sub Total</th>
                                                <th>Total Price</th>
                                                <th>Paid Amount</th>
                                                <th>Due Amount</th>
                                                <th>Order Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($batteryOrders as $order)
                                                <tr data-order-id="battery{{ $order->id }}" data-order-type="Battery">
                                                    <td><input type="checkbox"></td>
                                                    <td>{{ $order->order_id }}</td>
                                                    <td>{{ $order->order_type }}</td>
                                                    <td>{{ $order->battery_discount ?? '0' }}</td>
                                                    <td>{{ $order->old_battery_discount_value ?? '0' }} </td>
                                                    <td>{{ $order->subtotal }}</td>
                                                    <td>{{ $order->total_price }}</td>
                                                    <td>{{ $order->paid_amount }}</td>
                                                    <td>{{ $order->due_amount }}</td>
                                                    <td>{{ $order->order_date }}</td>

                                                </tr>
                                            @empty
                                            @endforelse

                                            @forelse ($replacementOrders as $order)
                                                <tr data-order-id="replacement{{ $order->id }}"
                                                    data-order-type="Replacement">
                                                    <td><input type="checkbox"></td>
                                                    <td>{{ $order->order->order_id }}</td>
                                                    <td>Replacement</td>
                                                    <td>{{ $order->battery_discount ?? '0' }}</td>
                                                    <td>{{ $order->old_battery_discount_value ?? '0' }} </td>
                                                    <td>{{ $order->subtotal }}</td>
                                                    <td>{{ $order->total_price }}</td>
                                                    <td>{{ $order->paid_amount }}</td>
                                                    <td>{{ $order->due_amount }}</td>
                                                    <td>{{ $order->updated_at->format('Y.m.d') }}</td>

                                                </tr>
                                            @empty
                                            @endforelse

                                            @forelse ($lubricantOrders as $order)
                                                <tr data-order-id="lubricant{{ $order->id }}"
                                                    data-order-type="Lubricant">
                                                    <td><input type="checkbox"></td>
                                                    <td>{{ $order->order_id }}</td>
                                                    <td>{{ $order->order_type }}</td>
                                                    <td>{{ $order->lubricant_discount ?? '0' }}</td>
                                                    <td>0.00</td>
                                                    <td>{{ $order->subtotal }}</td>
                                                    <td>{{ $order->total_price }}</td>
                                                    <td>{{ $order->paid_amount }}</td>
                                                    <td>{{ $order->due_amount }}</td>
                                                    <td>{{ $order->updated_at->format('Y.m.d') }}</td>

                                                </tr>
                                            @empty
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-4 customer-sidebar-left">
                                <div class="md-sidebar h-100"><a class="btn btn-primary md-sidebar-toggle"
                                        href="javascript:void(0)">Order
                                        Details</a>
                                    <div class="md-sidebar-aside custom-scrollbar responsive-order-details">
                                        <div class="card customer-sticky">

                                            <div class="card-body pt-0 order-details">

                                                <form id="order-form" method="POST"
                                                    action="{{ route('customer.payments.update') }}">
                                                    @csrf

                                                    <input type="hidden" name="customer_id" id="customer_id"
                                                        value="{{ $customerId ?? '' }}">

                                                    <div id="selected-orders-container"></div>
                                                    <!-- This will hold selected orders dynamically -->


                                                    <div class="widget-hover">
                                                        <h5 class="m-0 p-t-40">Payment Section</h5>

                                                        <div class="mb-4">
                                                            <label for="total_price" class="form-label">Total
                                                                Price</label>
                                                            <input type="number" id="total_price" name="total_price"
                                                                class="form-control" placeholder="Total Price" readonly />
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="subtotal" class="form-label">Sub Total
                                                            </label>
                                                            <input type="number" id="subtotal" name="subtotal"
                                                                class="form-control" placeholder="Sub Total" readonly />
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="discount" class="form-label">Discount</label>
                                                            <input type="number" id="discount" name="discount"
                                                                class="form-control" step="0.01"
                                                                placeholder="Enter discount" value="0" readonly />
                                                        </div>

                                                        <!-- Old Battery Discount Section -->
                                                        <div class="widget-hover">

                                                            <div class="mb-4">
                                                                <label for="old_battery_discount" class="form-label">Old
                                                                    Battery
                                                                    Discount</label>
                                                                <input type="number" id="old_battery_discount"
                                                                    name="old_battery_discount" class="form-control"
                                                                    placeholder="Old Battery Discount" value="0"
                                                                    readonly />
                                                            </div>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="paid_amount" class="form-label">Paid
                                                                Amount</label>
                                                            <input type="number" id="paid_amount" name="paid_amount"
                                                                class="form-control" step="0.01" value="0"
                                                                placeholder="" readonly />
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="payable_amount" class="form-label">Payable
                                                                Amount <span class="txt-danger">*</span></label>
                                                            <input type="number" id="payable_amount" name="payable_amount"
                                                                class="form-control" step="0.01"
                                                                placeholder="Enter price" required />
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="due_amount" class="form-label">Due Amount</label>
                                                            <input type="number" id="due_amount" name="due_amount"
                                                                class="form-control" step="0.01"
                                                                placeholder="Due Amount" readonly />
                                                        </div>
                                                        <div class="mb-4">
                                                            <label for="payment_type" class="form-label">Payment
                                                                Type <span class="txt-danger">*</span></label>
                                                            <select id="payment_type" name="payment_type"
                                                                class="form-select" required>
                                                                @foreach ($paymentTypes as $paymentType)
                                                                    <option value="{{ $paymentType }}">
                                                                        {{ $paymentType }}</option>
                                                                @endforeach

                                                                @foreach ($DBPaymentTypes as $paymentType)
                                                                    <option value="{{ $paymentType->id }}">
                                                                        {{ $paymentType->name }}</option>
                                                                @endforeach
                                                                {{-- <option id="selectedOption" value="${mainSelect}" style="display: none;"></option> --}}

                                                                <option value="Other">Other</option>
                                                            </select>
                                                        </div>

                                                        <div id="cheque_fields" style="display: none;">
                                                            <div class="mb-4">
                                                                <label for="cheque_number" class="form-label">Cheque
                                                                    Number</label>
                                                                <input type="text" id="cheque_number"
                                                                    name="cheque_number" class="form-control"
                                                                    placeholder="Enter cheque number" />
                                                            </div>

                                                            <div class="mb-4">
                                                                <label for="cheque_date" class="form-label">Cheque
                                                                    Date</label>
                                                                <input type="date" id="cheque_date" name="cheque_date"
                                                                    class="form-control"
                                                                    placeholder="Enter cheque date" />
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="place-order">

                                                        <input type="hidden" name="total_items" id="total_items">
                                                        <input type="hidden" name="subtotal" id="subtotal">
                                                        <input type="hidden" name="battery_discount"
                                                            id="battery_discount">
                                                        <input type="hidden" name="order_type" id="order_type">
                                                        <input type="hidden" name="old_battery_discount_value"
                                                            id="old_battery_discount_value">
                                                        <button id="place-order-btn"
                                                            class="btn btn-primary btn-hover-effect w-100 f-w-500"
                                                            type="submit">Place
                                                            Order</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const allButton = document.querySelector(".btn-success");
            const checkboxes = document.querySelectorAll("tbody input[type='checkbox']");
            const totalItemsField = document.getElementById("total_items");
            const subtotalField = document.getElementById("subtotal");
            const totalPriceField = document.getElementById("total_price");
            const dueAmountField = document.getElementById("due_amount");
            const paidAmountField = document.getElementById("paid_amount");
            const payableAmountField = document.getElementById("payable_amount");
            const discountField = document.getElementById("discount");
            const oldBatteryDiscountField = document.getElementById("old_battery_discount");

            const selectedOrdersContainer = document.getElementById("selected-orders-container");

            const form = document.getElementById("order-form"); // Your form ID

            function updateSelectedOrders() {
                selectedOrdersContainer.innerHTML = ""; // Clear previous selections

                let hasOrders = false;

                checkboxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                        const row = checkbox.closest("tr");
                        const orderId = row.getAttribute("data-order-id");
                        const orderType = row.getAttribute("data-order-type");

                        if (orderId && orderType) {
                            hasOrders = true;

                            // Create hidden inputs for each selected order
                            let orderIdInput = document.createElement("input");
                            orderIdInput.type = "hidden";
                            orderIdInput.name = `orders[${orderId}][id]`;
                            orderIdInput.value = orderId;

                            let orderTypeInput = document.createElement("input");
                            orderTypeInput.type = "hidden";
                            orderTypeInput.name = `orders[${orderId}][type]`;
                            orderTypeInput.value = orderType;

                            selectedOrdersContainer.appendChild(orderIdInput);
                            selectedOrdersContainer.appendChild(orderTypeInput);
                        }
                    }
                });

                // If no orders are selected, show an alert
                if (!hasOrders) {
                    alert("Please select at least one order before submitting.");
                }
            }

            function updateTotals() {
                let totalItems = 0,
                    subtotal = 0,
                    totalPrice = 0,
                    dueAmount = 0,
                    paidAmount = 0,
                    discount = 0,
                    oldBatteryDiscount = 0;

                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const row = checkbox.closest("tr");
                        totalItems++;
                        subtotal += parseFloat(row.children[5].innerText) || 0;
                        totalPrice += parseFloat(row.children[6].innerText) || 0;
                        paidAmount += parseFloat(row.children[7].innerText) || 0;
                        dueAmount += parseFloat(row.children[8].innerText) || 0;
                        discount += parseFloat(row.children[3].innerText) || 0;
                        oldBatteryDiscount += parseFloat(row.children[4].innerText) || 0;
                    }
                });

                totalItemsField.value = totalItems;
                subtotalField.value = subtotal.toFixed(2);
                totalPriceField.value = totalPrice.toFixed(2);
                dueAmountField.value = dueAmount.toFixed(2);
                paidAmountField.value = paidAmount.toFixed(2);
                discountField.value = discount.toFixed(2);
                oldBatteryDiscountField.value = oldBatteryDiscount.toFixed(2);
            }

            allButton.addEventListener("click", function() {
                checkboxes.forEach(checkbox => checkbox.checked = true);
                updateTotals();
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", updateTotals);
                checkbox.addEventListener("change", updateSelectedOrders);
            });

            payableAmountField.addEventListener("input", function() {
                dueAmountField.value = (totalPriceField.value - paidAmountField.value - discountField
                    .value - oldBatteryDiscountField.value - payableAmountField
                    .value).toFixed(2);
            });

            // Ensure orders are added before submitting
            form.addEventListener("submit", function(event) {
                updateSelectedOrders();
            });
        });

        document.getElementById('payment_type').addEventListener('change', function() {
            const chequeFields = document.getElementById('cheque_fields');
            if (this.value === 'Cheque') {
                chequeFields.style.display = 'block';
            } else {
                chequeFields.style.display = 'none';
                // Optionally clear the values if hidden
                document.getElementById('cheque_number').value = '';
                document.getElementById('cheque_date').value = '';
            }
        });
    </script>

    <!-- Modal -->
    <div class="modal fade" id="PaymentTypeModel" tabindex="-1" aria-labelledby="PaymentTypeModelLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="row mt-3 mx-3">
                    <div class="col-sm-8">
                        <h5 class="modal-title" id="PaymentTypeModelLabel">Enter Other Option</h5>
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('purchases_type.create') }}" target="_blank">
                            <button type="button" class="btn btn-primary">Create +</button>
                        </a>
                    </div>
                </div>

                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('purchases_type.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <label for="name" class="form-label">Payment Type Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter Payment Type">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.getElementById("payment_type").addEventListener("change", function() {
            const totalPriceInput = document.getElementById('total_price');
            const paidAmountInput = document.getElementById('payable_amount');
            const dueAmountInput = document.getElementById('due_amount');
            const paymentType = this.value;

            // If payment type is Credit
            if (paymentType === "Credit") {
                paidAmountInput.value = 0; // Set paid amount to 0
                dueAmountInput.value = totalPriceInput.value; // Set due amount to total price
                paidAmountInput.setAttribute('readonly', true); // Make paid amount readonly
            } else {
                // If payment type is not Credit, reset the values and remove readonly
                paidAmountInput.removeAttribute('readonly');
                dueAmountInput.value = totalPriceInput.value - paidAmountInput.value; // Calculate due amount
            }

            // If payment type is "Other", show modal
            if (paymentType === "Other") {
                var modal = new bootstrap.Modal(document.getElementById("PaymentTypeModel"));
                modal.show();
            }
        });
    </script>
@endsection

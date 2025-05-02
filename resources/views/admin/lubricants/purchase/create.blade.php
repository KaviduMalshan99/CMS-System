@extends('AdminDashboard.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Purchase Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('purchases.show', $purchase->id) : route('purchases.index') }}">
            Purchase
        </a></li>
    <li class="breadcrumb-item active">Add New Lubricant Purchase</li>
@endsection

@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header"></div>
            </div>

            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Add New Lubricant Purchase</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ route('purchases.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">Back</a>
                            </div>
                        </div>

                        <form id="saveForm" action="{{ route('lubricant_purchases.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="items" id="items">


                            <!-- Supplier -->
                            <div class="mb-4">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-select" required
                                    onchange="updateSupplierName()">
                                    <option value="" disabled selected>Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}" data-name="{{ $supplier->id }}">
                                            {{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <!-- Lubricant -->

                            <!-- Product -->
                            <div class="row gx-3">
                                <div class="col-md-6">
                                    <label for="lubricant_id" class="form-label">Lubricant</label>
                                    <select name="lubricant_id" id="lubricant_id" class="form-select" required>
                                        <option value="" disabled selected>Select Lubricant</option>
                                        @foreach ($lubricants as $lubricant)
                                            <option value="{{ $lubricant->id }}"
                                                data-purchase-price="{{ $lubricant->purchase_price }}">
                                                {{ $lubricant->type }} | {{ $lubricant->brand->brand_name }} | RS:
                                                {{ $lubricant->purchase_price }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>




                                <div class="col-md-6">
                                    <label for="add_product_view" class="form-label">Create New lubricants</label>
                                    <input type="button" id="add_product_view" class="form-control"
                                        value="Create New Lubricant"
                                        onclick="window.location.href='{{ route('lubricants.create') }}'" />
                                </div>
                            </div>

                            <!-- Quantity & Price -->
                            <div class="mt-4 row gx-3">
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="number" id="quantity" class="form-control"
                                        placeholder="Enter quantity" />
                                </div>
                                <div class="col-md-6">
                                    <label for="purchase_price" class="form-label">Purchase Price (Unit Price)</label>
                                    <input type="number" id="purchase_price" class="form-control" step="0.01"
                                        placeholder="Select Lubricant" />
                                </div>
                            </div>

                            <!-- Add Button -->
                            <div class="mb-4">
                                <br>
                                <button type="button" id="addProduct" class="btn btn-primary col-md-3">Add</button>
                            </div>

                            <!-- Dynamic Table -->
                            <table class="table table-bordered mt-4" id="productTable">
                                <thead>
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Lubricant</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>

                            <hr class="mt-4 form-horizontal">

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">


                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Payment Section</h2>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="total_price" class="form-label">Total Price</label>
                            <input type="number" id="total_price" name="total_price" class="form-control"
                                placeholder="Total Price" />
                        </div>
                        <div class="mb-4">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="number" id="paid_amount" name="paid_amount" class="form-control" step="0.01"
                                placeholder="Enter price" />
                        </div>
                        <div class="mb-4">
                            <label for="due_amount" class="form-label">Due Amount</label>
                            <input type="number" id="due_amount" name="due_amount" class="form-control" step="0.01"
                                placeholder="Due Amount" />
                        </div>

                        <div class="mb-4">
                            <label for="payment_type" class="form-label">Payment Type</label>
                            <select id="payment_type" name="payment_type" class="form-select" required>

                                @foreach ($paymentTypes as $paymentType)
                                    <option value="{{ $paymentType }}">{{ $paymentType }}</option>
                                @endforeach

                                @foreach ($DBPaymentTypes as $paymentType)
                                    <option value="{{ $paymentType->id }}">{{ $paymentType->name }}</option>
                                @endforeach
                                {{-- <option id="selectedOption" value="${mainSelect}" style="display: none;"></option> --}}

                                <option value="Other">Other</option>
                            </select>
                        </div>

                        <div id="cheque_fields" style="display: none;">
                            <div class="mb-4">
                                <label for="cheque_number" class="form-label">Cheque Number</label>
                                <input type="text" id="cheque_number" name="cheque_number" class="form-control"
                                    placeholder="Enter cheque number" />
                            </div>

                            <div class="mb-4">
                                <label for="cheque_date" class="form-label">Cheque Date</label>
                                <input type="date" id="cheque_date" name="cheque_date" class="form-control"
                                    placeholder="Enter cheque date" />
                            </div>
                        </div>


                        <!-- Display Section -->

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Select the input fields
                                const totalPriceField = document.getElementById('total_price');
                                const paidAmountField = document.getElementById('paid_amount');
                                const dueAmountField = document.getElementById('due_amount');
                                const paymentTypeField = document.getElementById('payment_type');

                                // Select the display fields
                                const displayTotalPrice = document.getElementById('display_total_price');
                                const displayPaidAmount = document.getElementById('display_paid_amount');
                                const displayDueAmount = document.getElementById('display_due_amount');
                                const displayPaymentType = document.getElementById('display_payment_type');
                                const chequeFields = document.getElementById('cheque_fields');

                                // Event listeners to update the displayed values
                                totalPriceField.addEventListener('input', function() {
                                    displayTotalPrice.value = totalPriceField.value;
                                    updateDueAmount();
                                });

                                paidAmountField.addEventListener('input', function() {
                                    displayPaidAmount.value = paidAmountField.value;
                                    updateDueAmount();
                                });

                                // Update due amount based on total price and paid amount
                                function updateDueAmount() {
                                    const totalPrice = parseFloat(totalPriceField.value) || 0;
                                    const paidAmount = parseFloat(paidAmountField.value) || 0;
                                    const dueAmount = totalPrice - paidAmount;
                                    displayDueAmount.value = dueAmount.toFixed(2);
                                }

                                // Handle payment type change
                                paymentTypeField.addEventListener('change', function() {
                                    displayPaymentType.value = paymentTypeField.options[paymentTypeField.selectedIndex].text;

                                    // Show or hide cheque fields based on the payment type
                                    if (paymentTypeField.value === 'Cheque') {
                                        chequeFields.style.display = 'block';
                                    } else {
                                        chequeFields.style.display = 'none';
                                    }
                                });
                            });
                        </script>





                        <!-- Display fields for selected values -->



                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Select the input fields
                                const totalPriceField = document.getElementById('total_price');
                                const paidAmountField = document.getElementById('paid_amount');
                                const dueAmountField = document.getElementById('due_amount');
                                const paymentTypeField = document.getElementById('payment_type');

                                // Select the display fields
                                const displayTotalPrice = document.getElementById('display_total_price');
                                const displayPaidAmount = document.getElementById('display_paid_amount');
                                const displayDueAmount = document.getElementById('display_due_amount');
                                const displayPaymentType = document.getElementById('display_payment_type');

                                // Event listeners to update the displayed values
                                totalPriceField.addEventListener('input', function() {
                                    displayTotalPrice.value = totalPriceField.value;
                                });

                                paidAmountField.addEventListener('input', function() {
                                    displayPaidAmount.value = paidAmountField.value;
                                });

                                dueAmountField.addEventListener('input', function() {
                                    displayDueAmount.value = dueAmountField.value;
                                });

                                paymentTypeField.addEventListener('change', function() {
                                    displayPaymentType.value = paymentTypeField.options[paymentTypeField.selectedIndex].text;
                                });
                            });
                        </script>

                        <script>
                            document.getElementById('lubricant_id').addEventListener('change', function() {
                                document.getElementById('lubricant_id2').value = this.value;
                            });
                        </script>


                        <input type="hidden" id="display_paid_amount" name="display_paid_amount" class="form-control"
                            readonly />
                        <input type="hidden" id="display_due_amount" name="display_due_amount" class="form-control"
                            readonly />
                        <input type="hidden" id="display_payment_type" name="display_payment_type" class="form-control"
                            readonly />

                        <input type="hidden" id="supplier_input1" name="supplier_id1">
                        <input type="hidden" id="lubricant_id2" name="lubricant_id2" class="form-control" readonly>
                        <input type="hidden" id="lubricant_input2" name="lubricant_id3">
                        <input type="hidden" id="quantity_input3" name="quantity3">
                        <input type="hidden" id="price_input4" name="purchase_price4">



                        <div class="mb-4">
                            <button type="submit" form="saveForm" class="btn btn-success col-md-6">Save</button>
                        </div>
                        </form>





                    </div>
                </div>
            </div>
        </div>
    </section>







    <!-- Option field outside the modal -->


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
            const paidAmountInput = document.getElementById('paid_amount');
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


    <script>
        document.getElementById('lubricant_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var purchasePrice = selectedOption.getAttribute('data-purchase-price');

            if (purchasePrice) {
                document.getElementById('purchase_price').value = purchasePrice;
            } else {
                document.getElementById('purchase_price').value = '';
            }
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
        document.getElementById('addProduct').addEventListener('click', function() {
            const supplierSelect = document.getElementById('supplier_id');
            const lubricantSelect = document.getElementById('lubricant_id');
            const quantityInput = document.getElementById('quantity');
            const priceInput = document.getElementById('purchase_price');
            const productTable = document.getElementById('productTable').querySelector('tbody');

            const supplierId = supplierSelect.value;
            const supplierName = supplierSelect.options[supplierSelect.selectedIndex].text;
            const lubricantId = lubricantSelect.value;
            const lubricantName = lubricantSelect.options[lubricantSelect.selectedIndex].text;
            const quantity = quantityInput.value;
            const price = priceInput.value;

            // Validate inputs
            if (!supplierId || !lubricantId || !quantity || !price) {
                alert('Please fill out all fields.');
                return;
            }

            // Add row to the table
            function appendValue(inputId, newValue) {
                let inputField = document.getElementById(inputId);
                if (inputField.value) {
                    inputField.value += `, ${newValue}`;
                } else {
                    inputField.value = newValue;
                }
            }

            const newRow = `
    <tr data-supplier-id="${supplierId}" data-lubricant-id="${lubricantId}" data-quantity="${quantity}" data-price="${price}">
        <td>${supplierName}</td>
        <td>${lubricantName}</td>
        <td>${quantity}</td>
        <td>${price}</td>
        <td>
            <button type="button" class="btn btn-sm btn-danger remove-row">Remove</button>
        </td>
    </tr>
`;

            // Append values with a comma separator
            appendValue('supplier_input1', supplierId);
            appendValue('lubricant_input2', lubricantId);
            appendValue('quantity_input3', quantity);
            appendValue('price_input4', price);


            productTable.insertAdjacentHTML('beforeend', newRow);

            // Clear inputs
            // supplierSelect.value = '';
            // lubricantSelect.value = '';
            quantityInput.value = '';
            priceInput.value = '';

            // Update hidden input with JSON data
            updateItems();
        });

        document.getElementById('productTable').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-row')) {
                event.target.closest('tr').remove();
                updateItems();
            }
        });

        function updateItems() {
            const productTable = document.getElementById('productTable').querySelector('tbody');
            const rows = productTable.querySelectorAll('tr');
            let totalPrice = 0;

            const items = Array.from(rows).map(row => {
                const quantity = parseFloat(row.getAttribute('data-quantity'));
                const price = parseFloat(row.getAttribute('data-price'));
                totalPrice += quantity * price; // Calculate total price
                return {
                    supplier_id: row.getAttribute('data-supplier-id'),
                    lubricant_id: row.getAttribute('data-lubricant-id'),
                    quantity,
                    purchase_price: price
                };
            });
            document.getElementById('items').value = JSON.stringify(items);

            document.getElementById('total_price').value = totalPrice.toFixed(2);
        }

        document.getElementById('paid_amount').addEventListener('input', function() {
            // Get the total price and paid amount inputs
            const totalPrice = parseFloat(document.getElementById('total_price').value) || 0;
            const paidAmount = parseFloat(this.value) || 0;

            // Calculate the due amount
            const dueAmount = Math.max(totalPrice - paidAmount, 0);

            // Update the due amount input
            document.getElementById('due_amount').value = dueAmount.toFixed(2);
        });
    </script>







@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dashboard_2.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection

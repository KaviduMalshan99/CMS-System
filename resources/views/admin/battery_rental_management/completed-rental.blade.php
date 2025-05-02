@extends('AdminDashboard.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Rental Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}">
            Rentals
        </a></li>
    <li class="breadcrumb-item active">Rental</li>
@endsection

@section('content')
    <section class="content-main">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-header">

                </div>
            </div>
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">

                        <div class="row gx-3">
                            <div class="col-md-11 mb-4">
                                <h2 class="content-title">Rentals</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form id="rentalForm" action="{{ route('rentals.updateCompletedRental', $rental->id) }}"
                            method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            @method('PUT')
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-10 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-select" disabled>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $customer->id == $rental->customer_id ? 'selected' : '' }}>
                                                {{ $customer->first_name }} {{ $customer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label for="add_customer_view" class="form-label">Create New</label>
                                    <input type="button" id="add_customer_view" class="form-control"
                                        value="Create New Customer"
                                        onclick="window.location.href='{{ route('customers.create') }}'" disabled />
                                </div>
                            </div>

                            <!-- Old Battery -->
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="old_battery_id" class="form-label">Old Battery</label>
                                    <select name="old_battery_id" id="old_battery_id" class="form-select" disabled>
                                        <option value="{{ $rental->old_battery_id }}" selected>
                                            {{ $rental->oldBattery->old_battery_type }}
                                            {{ $rental->oldBattery->old_battery_condition }}</option>
                                        @foreach ($oldBatteries as $oldBattery)
                                            <option value="{{ $oldBattery->id }}">
                                                {{ $oldBattery->old_battery_type }}
                                                {{ $oldBattery->old_battery_condition }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="old_battery_quantity my-2">Quantity</label>
                                    <input type="number" name="old_battery_quantity" class="form-control"
                                        value="{{ old('old_battery_quantity', $rental->old_battery_quantity ?? '') }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="rental_start_date" class="form-label">Rental Start Date</label>
                                    <input type="date" name="rental_start_date" placeholder="Type here"
                                        class="form-control" id="name"
                                        value="{{ old('rental_start_date', $rental->rental_start_date ?? '') }}"
                                        readonly />

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="rental_end_date" class="form-label">Rental End Date</label>
                                    <input type="date" name="rental_end_date" placeholder="Type here"
                                        class="form-control" id="name"
                                        value="{{ old('rental_end_date', $rental->rental_end_date ?? '') }}" readonly />

                                </div>
                            </div>



                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="rental_cost my-2">Rental Cost</label>
                                    <input type="number" name="rental_cost" class="form-control"
                                        value="{{ old('rental_cost', $rental->rental_cost ?? '') }}" readonly>


                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="advance_amount">Advance Amount</label>
                                    <input type="number" name="advance_amount" class="form-control"
                                        value="{{ old('advance_amount', $rental->advance_amount ?? '') }}" readonly>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="notes my-2">Note</label>
                                <textarea name="notes" placeholder="Type here" class="form-control" id="notes" readonly>{{ old('notes', $rental->notes ?? '') }}</textarea>
                            </div>

                            <div class=" mb-4">
                                <label for="actual_return_date" class="form-label">Actual Return Date <span
                                        class="txt-danger">*</span></label>
                                <input type="date" name="actual_return_date" placeholder="Type here" class="form-control"
                                    id="name"
                                    value="{{ old('actual_return_date', $rental->actual_return_date ?? '') }}" required />

                            </div>

                            <div class="row gx-3">
                                <div class="col-md-4 mb-4">
                                    <label for="late_return_fee" class="form-label">Late Return Fee</label>
                                    <input type="number" name="late_return_fee" placeholder="Type here"
                                        class="form-control" id="late_return_fee"
                                        value="{{ old('late_return_fee', $rental->late_return_fee) }}" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="damage_fee" class="form-label">Damage Fee</label>
                                    <input type="number" name="damage_fee" placeholder="Type here" class="form-control"
                                        id="damage_fee" value="{{ old('damage_fee', $rental->damage_fee) }}" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="total_cost" class="form-label">Total Cost</label>
                                    <input type="number" name="total_cost" placeholder="Type here" class="form-control"
                                        id="total_cost" readonly
                                        value="{{ old('total_cost', $rental->damage_fee + $rental->late_return_fee + $rental->rental_cost) }}" />
                                </div>
                            </div>

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

                        <!--  Price -->
                        <div class="mb-4">
                            <label for="total_price" class="form-label">Total Amount</label>
                            <input type="number" id="total_price" name="total_price" class="form-control"
                                placeholder="Total Cost" value="{{ $rental->total_cost }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="adavancePrice" class="form-label">Advance Amount</label>
                            <input type="number" id="adavancePrice" name="adavancePrice" class="form-control"
                                placeholder="advance Cost" value="{{ $rental->advance_amount }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="total_price_after_advance" class="form-label">Total Amount (after reduce advance
                                amount)</label>
                            <input type="number" id="total_price_after_advance" name="total_price_after_advance"
                                class="form-control" placeholder="Total Cost"
                                value="{{ $rental->total_cost - $rental->advance_amount }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="number" id="paid_amount" name="paid_amount"
                                value="{{ $rental->paid_amount }}" class="form-control" step="0.01"
                                placeholder="Enter price" readonly />
                        </div>

                        <!-- payment -->
                        <div class="mb-4">
                            <label for="due_amount" class="form-label">Due Amount</label>
                            <input type="number" id="due_amount" name="due_amount" class="form-control" step="0.01"
                                placeholder="Due Amount" readonly value="{{ $rental->due_amount }}" />
                        </div>

                        <div class="mb-4">
                            <label for="payable_amount" class="form-label">Payable Amount</label>
                            <input type="number" id="payable_amount" name="payable_amount" class="form-control"
                                step="0.01" placeholder="Payable Amount" />
                        </div>
                        <div class="mb-4">
                            <label for="payment_type" class="form-label">Payment Type <span
                                    class="txt-danger">*</span></label>
                            <select id="payment_type" name="payment_type" class="form-select" required>
                                @foreach ($paymentTypes as $paymentType)
                                    <option value="{{ $paymentType }}"
                                        {{ $paymentType == $rental->payment_type ? 'selected' : '' }}>{{ $paymentType }}
                                    </option>
                                @endforeach

                                @foreach ($DBPaymentTypes as $paymentType)
                                    <option value="{{ $paymentType->id }}"
                                        {{ $paymentType->id == $rental->payment_type ? 'selected' : '' }}>
                                        {{ $paymentType->name }}</option>
                                @endforeach

                                <option value="Other">Other</option>
                            </select>

                        </div>

                        <div id="cheque_fields" style="display: none;">
                            <div class="mb-4">
                                <label for="cheque_number" class="form-label">Cheque Number</label>
                                <input type="text" id="cheque_number" name="cheque_number" class="form-control"
                                    placeholder="Enter cheque number" value="{{ $rental->cheque_number }}" />
                            </div>

                            <div class="mb-4">
                                <label for="cheque_date" class="form-label">Cheque Date</label>
                                <input type="date" id="cheque_date" name="cheque_date" class="form-control"
                                    placeholder="Enter cheque date" value="{{ $rental->cheque_date }}" />
                            </div>
                        </div>

                        <!-- Additional Combo Boxes in Payment Section -->
                        <div class="row gx-3 mb-4">
                            <div class="col-md-6" hidden>
                                <label for="tax_option" class="form-label">Tax</label>
                                <select id="tax_option" name="tax_option" class="form-select">
                                    <option value="exclude" {{ $rental->tax_id == null ? 'selected' : '' }}>Tax Exclude
                                    </option>
                                    <option value="include" {{ $rental->tax_id != null ? 'selected' : '' }}>Tax Include
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tax_id" class="form-label">Tax (%)</label>
                                <select id="tax_id" name="tax_id" class="form-select">
                                    <option value="" selected>Select Tax Percentage</option>
                                    @foreach ($taxes as $tax)
                                        <option value="{{ $tax->id }}">{{ $tax->percentage }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="need_tax_invoice" class="form-label">Need Tax Invoice</label>
                                <select id="need_tax_invoice" name="need_tax_invoice" class="form-select">
                                    <option value="0" selected>No
                                    </option>
                                    <option value="1">Yes
                                    </option>
                                </select>
                            </div>
                        </div>


                        <!-- Hidden field for Total Amount Including Tax -->
                        {{-- <div class="mb-4" hidden>
                            <input type="text" id="tax_id" name="tax_id" class="form-control">
                        </div> --}}

                        <!-- Hidden field for Total Amount Including Tax -->
                        <div class="mb-4" hidden>
                            <input type="text" id="tax_paid" name="tax_paid" class="form-control">
                        </div>

                        <!-- Modal for Tax Details -->
                        <div class="modal fade" id="taxModal" tabindex="-1" aria-labelledby="taxModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form class="row g-3 needs-validation" id="taxForm" novalidate>
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="taxModalLabel">Enter Tax Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="tax_percentage" class="form-label">Tax Percentage</label>
                                                <input type="number" id="tax_percentage" name="tax_percentage"
                                                    class="form-control" placeholder="Enter tax percentage">
                                            </div>
                                            <div class="mb-3">
                                                <label for="modal_customer_name" class="form-label">Customer Name</label>
                                                <input type="text" id="modal_customer_name" class="form-control"
                                                    value="{{ $rental->customer->first_name }} {{ $rental->customer->last_name }}"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tax_holder_name" class="form-label">Tax Holder Name</label>
                                                <input type="text" id="tax_holder_name" class="form-control"
                                                    value="{{ $rental->customer->tax_holder_name ?? '' }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tax_number" class="form-label">Tax Number</label>
                                                <input type="text" id="tax_number" class="form-control"
                                                    value="{{ $rental->customer->tax_number ?? '' }}" readonly>
                                            </div>
                                            <div class="alert alert-warning" id="tax_warning" style="display:none;">
                                                You cannot add Tax, please update the Customer.
                                            </div>
                                            <div id="formMessage"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" id="addTaxButton">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="mb-4">
                            <button type="submit" form="rentalForm" class="btn btn-success col-md-6">Proceed</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

    <!-- Tax Combo Box & Modal Script -->
    <script>
        // Show modal when "Tax Include" is selected
        document.getElementById('tax_option').addEventListener('change', function() {
            if (this.value === 'include') {
                var taxModal = new bootstrap.Modal(document.getElementById('taxModal'));
                // Check if tax_holder_name or tax_number are empty
                var taxHolder = document.getElementById('tax_holder_name').value.trim();
                var taxNumber = document.getElementById('tax_number').value.trim();
                if (!taxHolder || !taxNumber) {
                    document.getElementById('tax_warning').style.display = 'block';
                    document.getElementById('addTaxButton').disabled = true;
                } else {
                    document.getElementById('tax_warning').style.display = 'none';
                    document.getElementById('addTaxButton').disabled = false;
                }
                taxModal.show();
            }
        });

        // When the Add button is clicked in the modal, calculate and display Total Amount Including Tax
        document.getElementById('tax_id').addEventListener('click', function(e) {
            e.preventDefault();

            var taxHolder = document.getElementById('tax_holder_name').value.trim();
            var taxNumber = document.getElementById('tax_number').value.trim();
            if (!taxHolder || !taxNumber) {
                alert("Update Customer Tax Information");
                this.value = "";
                // this.disabled = true;
            } else {
                // this.disabled = false;
            }

        });

        // When the Add button is clicked in the modal, calculate and display Total Amount Including Tax
        document.getElementById('tax_id').addEventListener('change', function(e) {
            e.preventDefault();

            // Get selected customer ID from the dropdown
            const customerSelect = document.getElementById("customer_id");
            const customerId = customerSelect.value;

            if (customerId == "") {
                alert("Please select a customer.");
                this.value = "";
                return;
            }

            // Immediately recalc overall totals to reflect the new tax amount
            updateTaxTotal();

        });

        // When the Add button is clicked in the modal, calculate and display Total Amount Including Tax
        document.getElementById('addTaxButton').addEventListener('click', async function(e) {
            e.preventDefault();

            const formData = new FormData();

            // Get selected customer ID from the dropdown
            const customerSelect = document.getElementById("customer_id");
            const customerId = customerSelect.value;

            if (customerId == "") {
                const messageContainer = document.getElementById("formMessage");
                messageContainer.innerHTML =
                    `<div class="alert alert-danger">Please select a customer.</div>`;
                return;
            }

            // Append customer ID to the form data
            formData.append("customer_id", customerId);
            formData.append("percentage", document.getElementById('tax_percentage').value);

            try {
                // Send data to the server using fetch
                const response = await fetch("{{ route('tax.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: formData,
                });

                const result = await response.json();

                // Handle success or error messages
                const messageContainer = document.getElementById("formMessage");
                if (response.ok) {

                    document.getElementById("tax_id").value = result.data.id;

                    updateTaxTotal();
                    var taxModal = bootstrap.Modal.getInstance(document.getElementById('taxModal'));
                    taxModal.hide();
                } else {
                    messageContainer.innerHTML =
                        `<div class="alert alert-danger">${result.message || "Something went wrong!"}</div>`;
                }
            } catch (error) {
                console.error("Error:", error);
                const messageContainer = document.getElementById("formMessage");
                messageContainer.innerHTML =
                    `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
            }



        });

        function updateTaxTotal() {
            // Get base values
            const rawTotal = parseFloat(document.getElementById('total_cost').value) || 0;
            // const advance = parseFloat(document.getElementById('advance_amount').value) || 0;
            const advance = parseFloat({{ $rental->advance_amount ?? 0 }});
            const paid = parseFloat(document.getElementById('paid_amount').value) || 0;
            const payable = parseFloat(document.getElementById('payable_amount').value) || 0;
            const taxOption = document.getElementById('tax_option').value;
            const taxPct = parseFloat(document.getElementById('tax_percentage').value) || 0;

            let taxSelect = document.getElementById('tax_id');
            let selectedOption = taxSelect.options[taxSelect.selectedIndex];
            let taxPercentage1 = selectedOption.textContent.trim();

            let taxAmount = 0;

            let adjustedTotal, adjustedAfterAdvance;
            if (taxOption === 'include') {
                adjustedTotal = rawTotal * (1 + taxPct / 100);
                adjustedAfterAdvance = (adjustedTotal - advance);

                taxAmount = rawTotal * (taxPct / 100);
                document.getElementById('tax_paid').value = taxAmount.toFixed(2);

            } else if (taxSelect.value != "") {
                adjustedTotal = rawTotal * (taxPercentage1 / 100);
                adjustedAfterAdvance = (adjustedTotal - advance);
                taxAmount = rawTotal * (taxPercentage1 / 100);
                // Update hidden field for tax_paid so it can be displayed if needed
                document.getElementById("tax_paid").value = taxAmount.toFixed(2);
            } else {
                adjustedTotal = rawTotal;
                adjustedAfterAdvance = rawTotal - advance;

                document.getElementById('tax_paid').value = "0.00";
            }


            // Set adjusted total fields
            document.getElementById('total_price').value = (rawTotal + taxAmount).toFixed(2);
            document.getElementById('total_price_after_advance').value = (rawTotal + taxAmount - advance).toFixed(2)

            // Calculate and update due amount (tax adjusted)
            const due = rawTotal - paid - advance - payable + taxAmount;
            document.getElementById('due_amount').value = due.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const lateReturnFeeInput = document.getElementById('late_return_fee');
            const damageFeeInput = document.getElementById('damage_fee');
            const taxPctInput = document.getElementById('tax_percentage');
            const taxOptionSelect = document.getElementById('tax_option');
            const payableInput = document.getElementById('payable_amount');

            // Update whenever any relevant field changes
            lateReturnFeeInput.addEventListener('input', updateTaxTotal);
            damageFeeInput.addEventListener('input', updateTaxTotal);
            taxPctInput.addEventListener('input', updateTaxTotal);
            taxOptionSelect.addEventListener('change', updateTaxTotal);
            payableInput.addEventListener('input', updateTaxTotal);


        });
    </script>

    <script>
        document.getElementById("payment_type").addEventListener("change", function() {
            const totalPriceInput = document.getElementById('total_price');
            const paidAmountInput = document.getElementById('paid_amount');
            const payable_amount = document.getElementById('payable_amount');
            const advance_amount = document.getElementById('adavancePrice');
            const dueAmountInput = document.getElementById('due_amount');
            const paymentType = this.value;

            // If payment type is Credit
            if (paymentType === "Credit") {
                payable_amount.value = 0; // Set paid amount to 0
                dueAmountInput.value = totalPriceInput.value - paidAmountInput
                    .value; // Set due amount to total price
                payable_amount.setAttribute('readonly', true); // Make paid amount readonly
            } else {
                // If payment type is not Credit, reset the values and remove readonly
                payable_amount.removeAttribute('readonly');
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
        // Function to handle cheque fields visibility
        function toggleChequeFields() {
            const paymentType = document.getElementById('payment_type').value;
            const chequeFields = document.getElementById('cheque_fields');
            if (paymentType === 'Cheque') {
                chequeFields.style.display = 'block';
            } else {
                chequeFields.style.display = 'none';
                // Optionally clear values if hiding
                document.getElementById('cheque_number').value = '';
                document.getElementById('cheque_date').value = '';
            }
        }

        // Attach change event listener to Payment Type dropdown
        document.getElementById('payment_type').addEventListener('change', toggleChequeFields);

        // Call function on page load to handle pre-selected value
        document.addEventListener('DOMContentLoaded', toggleChequeFields);

        document.addEventListener('DOMContentLoaded', function() {
            const totalCostInput = document.getElementById('total_cost');
            const totalPriceAfterAdvance = document.getElementById('total_price_after_advance');
            const paidAmountInput = document.getElementById('paid_amount');
            const advanceAmount = parseFloat({{ $rental->advance_amount ?? 0 }});
            const totalPriceInput = document.getElementById('total_price');
            const dueAmountInput = document.getElementById('due_amount');
            const payableAmountInput = document.getElementsByName('payable_amount')[0];

            const lateReturnFeeInput = document.getElementById('late_return_fee');
            const damageFeeInput = document.getElementById('damage_fee');
            const rentalCost = parseFloat({{ $rental->rental_cost ?? 0 }});

            const taxOptionSelect = document.getElementById('tax_option');

            const taxPaidInput = document.getElementById('tax_paid');



            function updateTotalCost() {
                const lateReturnFee = parseFloat(lateReturnFeeInput.value) || 0;
                const damageFee = parseFloat(damageFeeInput.value) || 0;
                totalCostInput.value = (lateReturnFee + damageFee + rentalCost).toFixed(2);
                totalPriceInput.value = (lateReturnFee + damageFee + rentalCost).toFixed(2);
                totalPriceAfterAdvance.value = (lateReturnFee + damageFee + rentalCost - advanceAmount).toFixed(2);
            }

            function updatePaymentSection() {
                const totalCost = parseFloat(totalCostInput.value) || 0;
                const paidAmount = parseFloat(paidAmountInput.value) || 0;

                // Update total price
                totalPriceInput.value = totalCost.toFixed(2) - advanceAmount;

                // Update due amount
                const dueAmount = totalCost - paidAmount - advanceAmount;
                dueAmountInput.value = dueAmount.toFixed(2);
            }

            function updateDueAmount() {
                const totalCost = parseFloat(totalCostInput.value) || 0;
                const paidAmount = parseFloat(paidAmountInput.value) || 0;
                const payableAmount = parseFloat(payableAmountInput.value) || 0;
                const taxPaid = parseFloat(taxPaidInput.value) || 0;

                const tt = totalCost + taxPaid;

                const dueAmount = tt - paidAmount - payableAmount;
                dueAmountInput.value = dueAmount.toFixed(2);
            }

            // Add event listener for payable_amount changes
            payableAmountInput.addEventListener('input', updateDueAmount);

            // Add event listeners to trigger updates
            totalCostInput.addEventListener('input', updatePaymentSection);
            paidAmountInput.addEventListener('input', updatePaymentSection);

            // Attach event listeners
            lateReturnFeeInput.addEventListener('input', updateTotalCost);
            damageFeeInput.addEventListener('input', updateTotalCost);
            taxOptionSelect.addEventListener('change', updateTotalCost);

            lateReturnFeeInput.addEventListener('input', updateDueAmount);
            damageFeeInput.addEventListener('input', updateDueAmount);
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

@extends('AdminDashboard.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Repair Management</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"> <a class="breadcrumb-item"
            href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}">
            Repairs
        </a></li>
    <li class="breadcrumb-item active">Battery Repair</li>
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
                                <h2 class="content-title">Battery Repairs</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form id="repairForm" action="{{ route('repairs.updateCompletedRepair', $repair) }}" method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            @method('PUT')
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-10 mb-4">
                                    <label for="customer_id" class="form-label">Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-select" disabled>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $customer->id == $repair->customer_id ? 'selected' : '' }}>
                                                {{ $customer->first_name }} {{ $customer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label for="add_customer_view" class="form-label">Create New Customer</label>
                                    <input type="button" id="add_customer_view" class="form-control"
                                        value="Create New Customer"
                                        onclick="window.location.href='{{ route('customers.create') }}'" disabled />
                                </div>
                            </div>

                            <!-- Battery -->
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="type my-2">Type</label>
                                    <input type="text" name="type" class="form-control"
                                        value="{{ old('type', $repair->repairBattery->type) }}" disabled>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="brand">Brand</label>
                                    <input type="text" name="brand" class="form-control"
                                        value="{{ old('brand', $repair->repairBattery->brand->brand_name ?? '') }}"
                                        disabled>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="model_number my-2">Model Number</label>
                                <input type="text" name="model_number" class="form-control"
                                    value="{{ old('model_number', $repair->repairBattery->model_number ?? '') }}" disabled>
                            </div>


                            <div class="mb-4">
                                <label for="diagnostic_report" class="form-label">Diagnostic Report</label>
                                <textarea name="diagnostic_report" placeholder="Type here" class="form-control" id="diagnostic_report" disabled>{{ old('diagnostic_report', $repair->diagnostic_report) }}</textarea>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="repair_order_end_date" class="form-label">Repair Order End Date</label>
                                    <input type="date" name="repair_order_end_date" placeholder="Type here"
                                        class="form-control" id="name"
                                        value="{{ old('model_number', $repair->repair_order_end_date ?? '') }}" disabled>

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="advance_amount">Advance Amount</label>
                                    <input type="number" name="advance_amount" id="advance_amount" class="form-control"
                                        value="{{ old('advance_amount', $repair->advance_amount) }}" readonly>
                                </div>
                            </div>


                            <div class="mb-4">
                                <label for="items_used" class="form-label">Items Used <span
                                        class="txt-danger">*</span></label>
                                <textarea name="items_used" placeholder="Type here" required class="form-control" id="items_used">{{ old('items_used', $repair->items_used) }}</textarea>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-4 mb-4">
                                    <label for="repair_cost" class="form-label">Repair Cost <span
                                            class="txt-danger">*</span></label>
                                    <input type="number" name="repair_cost" placeholder="Type here" class="form-control"
                                        required id="repair_cost"
                                        value="{{ old('repair_cost', $repair->repair_cost) }}" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="labor_charges" class="form-label">Labor Charges <span
                                            class="txt-danger">*</span></label>
                                    <input type="number" name="labor_charges" placeholder="Type here"
                                        class="form-control" required id="labor_charges"
                                        value="{{ old('labor_charges', $repair->labor_charges) }}" />
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label for="total_cost" class="form-label">Total Cost</label>
                                    <input type="number" name="total_cost" placeholder="Type here" class="form-control"
                                        required id="total_cost" readonly
                                        value="{{ old('total_cost', $repair->total_cost) }}" />
                                </div>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="repair_status" class="form-label">Repair Status <span
                                            class="txt-danger">*</span></label>
                                    <select name="repair_status" id="repair_status" class="form-select" required>
                                        <option value="In Progress"
                                            {{ $repair->repair_status == 'In Progress' ? 'selected' : '' }}>In Progress
                                        </option>
                                        <option value="Completed"
                                            {{ $repair->repair_status == 'Completed' ? 'selected' : '' }}>Completed
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="delivery_status" class="form-label">Delivery Status <span
                                            class="txt-danger">*</span></label>
                                    <select name="delivery_status" id="delivery_status" class="form-select" required>
                                        <option value="Not Delivered"
                                            {{ $repair->delivery_status == 'Not Delivered' ? 'selected' : '' }}>Not
                                            Delivered
                                        </option>
                                        <option value="Delivered"
                                            {{ $repair->delivery_status == 'Delivered' ? 'selected' : '' }}>
                                            Delivered</option>

                                    </select>
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
                                placeholder="Total Cost" value="{{ $repair->total_cost }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="adavancePrice" class="form-label">Advance Amount</label>
                            <input type="number" id="adavancePrice" name="adavancePrice" class="form-control"
                                placeholder="advance Cost" value="{{ $repair->advance_amount }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="total_price" class="form-label">Total Amount (after reduce advance
                                amount)</label>
                            <input type="number" id="total_price_after_advance" name="total_price_after_advance"
                                class="form-control" placeholder="Total Cost"
                                value="{{ $repair->total_cost - $repair->advance_amount }}" readonly />
                        </div>
                        <div class="mb-4">
                            <label for="paid_amount" class="form-label">Paid Amount</label>
                            <input type="number" id="paid_amount" name="paid_amount"
                                value="{{ $repair->paid_amount }}" class="form-control" step="0.01"
                                placeholder="Enter price" readonly />
                        </div>

                        <!-- payment -->
                        <div class="mb-4">
                            <label for="due_amount" class="form-label">Due Amount</label>
                            <input type="number" id="due_amount" name="due_amount" class="form-control" step="0.01"
                                placeholder="Due Amount" readonly value="{{ $repair->due_amount }}" />
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
                                        {{ $paymentType == $repair->payment_type ? 'selected' : '' }}>{{ $paymentType }}
                                    </option>
                                @endforeach
                                @foreach ($DBPaymentTypes as $paymentType)
                                    <option value="{{ $paymentType->id }}"
                                        {{ $paymentType->id == $repair->payment_type ? 'selected' : '' }}>
                                        {{ $paymentType->name }}</option>
                                @endforeach

                                <option value="Other">Other</option>
                            </select>

                        </div>

                        <div id="cheque_fields" style="display: none;">
                            <div class="mb-4">
                                <label for="cheque_number" class="form-label">Cheque Number</label>
                                <input type="text" id="cheque_number" name="cheque_number" class="form-control"
                                    placeholder="Enter cheque number" value="{{ $repair->cheque_number }}" />
                            </div>

                            <div class="mb-4">
                                <label for="cheque_date" class="form-label">Cheque Date</label>
                                <input type="date" id="cheque_date" name="cheque_date" class="form-control"
                                    placeholder="Enter cheque date" value="{{ $repair->cheque_date }}" />
                            </div>
                        </div>

                        <!-- Additional Combo Boxes in Payment Section -->
                        <div class="row gx-3 mb-4">
                            <div class="col-md-6" hidden>
                                <label for="tax_option" class="form-label">Tax</label>
                                <select id="tax_option" name="tax_option" class="form-select">
                                    <option value="exclude" {{ $repair->tax_id == null ? 'selected' : '' }}>Tax Exclude
                                    </option>
                                    <option value="include" {{ $repair->tax_id != null ? 'selected' : '' }}>Tax Include
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
                                                    value="{{ $repair->customer->first_name }} {{ $repair->customer->last_name }}"
                                                    readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tax_holder_name" class="form-label">Tax Holder Name</label>
                                                <input type="text" id="tax_holder_name" class="form-control"
                                                    value="{{ $repair->customer->tax_holder_name ?? '' }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tax_number" class="form-label">Tax Number</label>
                                                <input type="text" id="tax_number" class="form-control"
                                                    value="{{ $repair->customer->tax_number ?? '' }}" readonly>
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
                            <button type="submit" form="repairForm" class="btn btn-success col-md-6">Proceed</button>
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
            const advance = parseFloat(document.getElementById('advance_amount').value) || 0;
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
                adjustedTotal = rawTotal * (taxPct / 100);
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
            const repairCostInput = document.getElementById('repair_cost');
            const laborChargesInput = document.getElementById('labor_charges');
            const taxPctInput = document.getElementById('tax_percentage');
            const taxOptionSelect = document.getElementById('tax_option');
            const payableInput = document.getElementById('payable_amount');

            // Update whenever any relevant field changes
            repairCostInput.addEventListener('input', updateTaxTotal);
            laborChargesInput.addEventListener('input', updateTaxTotal);
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
            const advance_amount = document.getElementById('advance_amount');
            const dueAmountInput = document.getElementById('due_amount');
            const paymentType = this.value;

            // If payment type is Credit
            if (paymentType === "Credit") {
                payable_amount.value = 0; // Set paid amount to 0
                dueAmountInput.value = totalPriceInput.value - paidAmountInput.value - advance_amount
                    .value; // Set due amount to total price
                payable_amount.setAttribute('readonly', true); // Make paid amount readonly
            } else {
                // If payment type is not Credit, reset the values and remove readonly
                payable_amount.removeAttribute('readonly');
                dueAmountInput.value = totalPriceInput.value - paidAmountInput.value - advance_amount
                    .value; // Calculate due amount
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
            const advanceAmount = parseFloat({{ $repair->advance_amount ?? 0 }});
            const totalPriceInput = document.getElementById('total_price');
            const repairCostInput = document.getElementById('repair_cost');
            const laborChargesInput = document.getElementById('labor_charges');
            const dueAmountInput = document.getElementById('due_amount');
            // const payableAmountInput = document.getElementsByName('payable_amount')[0];

            const taxOptionSelect = document.getElementById('tax_option');


            function updateTotalCost() {
                const repairCost = parseFloat(repairCostInput.value) || 0;
                const laborCharges = parseFloat(laborChargesInput.value) || 0;
                totalCostInput.value = (repairCost + laborCharges).toFixed(2);
                totalPriceInput.value = (repairCost + laborCharges).toFixed(2);
                totalPriceAfterAdvance.value = (repairCost + laborCharges - advanceAmount).toFixed(2);
            }

            // Attach event listeners
            repairCostInput.addEventListener('input', updateTotalCost);
            laborChargesInput.addEventListener('input', updateTotalCost);
            taxOptionSelect.addEventListener('change', updateTotalCost);

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

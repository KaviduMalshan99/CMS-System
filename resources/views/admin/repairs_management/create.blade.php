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
    <li class="breadcrumb-item active">Add New Repair</li>
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
                                <h2 class="content-title">Add New Repairs</h2>
                            </div>
                            <div class="col-md-1 mb-4">
                                <a href="{{ request()->query('ref') === 'view' ? route('repairs.show', $repair->id) : route('repairs.index') }}"
                                    class="btn btn-light rounded font-sm mr-5 text-body hover-up">
                                    Back
                                </a>
                            </div>
                        </div>

                        <form id="repairForm" action="{{ route('repairs.store') }}" method="POST">
                            @csrf <!-- Laravel's CSRF protection -->
                            <!-- Customer -->
                            <div class="row gx-3">
                                <div class="col-md-10 mb-4">
                                    <label for="customer_id" class="form-label">Customer <span
                                            class="txt-danger">*</span></label>
                                    <select name="customer_id" id="customer_id" class="form-select" required>
                                        <option value="" disabled selected>Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->first_name }}
                                                {{ $customer->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label for="add_customer_view" class="form-label">Create New Customer</label>
                                    <input type="button" id="add_customer_view" class="form-control"
                                        value="Create New Customer"
                                        onclick="window.location.href='{{ route('customers.create') }}'" />

                                </div>
                            </div>
                            <!-- Battery -->
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="type my-2">Type <span class="txt-danger">*</span></label>
                                    <input type="text" name="type" class="form-control"
                                        value="{{ old('type', $battery->type ?? '') }}" required placeholder="Type here">

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="brand_id" class="pb-0">Brand</label>
                                    <select id="brand_id" name="brand_id" class="form-select">
                                        <option value="" disabled>Select brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">
                                                {{ $brand->type }} | {{ $brand->brand_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="model_number my-2">Model Number <span class="txt-danger">*</span></label>
                                <input type="text" name="model_number" class="form-control"
                                    value="{{ old('model_number', $battery->model_number ?? '') }}" required
                                    placeholder="Type here">

                            </div>

                            <div class="mb-4">
                                <label for="diagnostic_report" class="form-label">Diagnostic Report <span
                                        class="txt-danger">*</span></label>
                                <textarea name="diagnostic_report" placeholder="Type here" class="form-control" id="diagnostic_report" required></textarea>

                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="repair_order_end_date" class="form-label">Repair Order End Date</label>
                                    <input type="date" name="repair_order_end_date" placeholder="Type here"
                                        class="form-control" id="name" />

                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="advance_amount">Advance Amount</label>
                                    <input type="number" name="advance_amount" class="form-control"
                                        placeholder="Type here">
                                </div>
                            </div>

                            <!-- Battery -->
                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="isForSelling" class="pb-0">Is For Selling</label>
                                    <select id="isForSelling" name="isForSelling" class="form-select">
                                        <option value="0">
                                            NO
                                        </option>
                                        <option value="1">
                                            YES
                                        </option>
                                    </select>

                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="stock_quantity">Stock Quantity</label>
                                    <input type="number" name="stock_quantity" class="form-control"
                                        placeholder="Type here">
                                </div>
                            </div>

                            <div class="row gx-3">
                                <div class="col-md-6 mb-4">
                                    <label for="purchase_price">Purchase Price</label>
                                    <input type="number" name="purchase_price" class="form-control"
                                        placeholder="Type here">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="number" name="selling_price" class="form-control"
                                        placeholder="Type here">
                                </div>
                            </div>

                            <div class="mb-4">
                                {{-- <button type="submit" form="repairForm" class="btn btn-success col-md-3">Save</button> --}}
                                <button type="button" class="btn btn-success col-md-3" data-bs-toggle="modal"
                                    data-bs-target="#rentalModal">
                                    Save
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confirmation Modal -->
        <div class="modal fade" id="rentalModal" tabindex="-1" aria-labelledby="rentalModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rentalModalLabel">Rental Section</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you want to go to the Rental Section?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="submitForm(0)">No</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm(1)">Yes</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script>
        // Function to handle field visibility
        function toggleFieldVisibility() {
            const isForSelling = document.getElementById('isForSelling');
            const fieldsToToggle = [
                'stock_quantity',
                'purchase_price',
                'selling_price'
            ];

            // Function to show/hide fields based on selection
            const toggleFields = () => {
                const shouldShow = isForSelling.value === '1';
                fieldsToToggle.forEach(fieldName => {
                    const field = document.querySelector(`[name="${fieldName}"]`);
                    const fieldContainer = field.closest('.col-md-6');
                    fieldContainer.style.display = shouldShow ? 'block' : 'none';
                });
            };

            // Set initial state to "No" and hide fields
            isForSelling.value = '0';
            toggleFields();

            // Add event listener for changes
            isForSelling.addEventListener('change', toggleFields);
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', toggleFieldVisibility);
    </script>

    <script>
        function submitForm(goToRentalValue) {
            // Add a hidden input to include go_to_rental value
            let form = document.getElementById('repairForm');
            let existingInput = document.getElementById('go_to_rental');

            if (!existingInput) {
                let input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'go_to_rental';
                input.id = 'go_to_rental';
                form.appendChild(input);
            }

            document.getElementById('go_to_rental').value = goToRentalValue;

            // Submit the form
            form.submit();
        }
    </script>

@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}">
        < /> <
        script src = "{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}" >
    </script>
    <script src="{{ asset('assets/js/counter/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/counter/counter-custom.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard/dashboard_2.js') }}"></script>
    <script src="{{ asset('assets/js/animation/wow/wow.min.js') }}"></script>
@endsection

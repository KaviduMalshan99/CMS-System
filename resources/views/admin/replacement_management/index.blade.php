@extends('AdminDashboard.master')
@section('title', 'POS')

@section('css')

@endsection

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pos/css/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pos/css/swiper/swiper.min.css') }}">

    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/pos/css/style.css') }}">

@endsection

@section('breadcrumb-title')
    <h3>POS</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">POS</li>
@endsection

@section('content')

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body btn-showcase">
                                <style>
                                    .btn-showcase {
                                        display: flex;
                                        gap: 10px;
                                        flex-wrap: wrap;
                                    }

                                    .btn-showcase .btn {
                                        flex: 1;
                                        min-width: 150px;
                                        white-space: nowrap;
                                    }
                                </style>
                                <button id="newBatteryBtn" class="btn btn-pill btn-outline-primary" type="button">New
                                    Battery</button>
                                <button id="oldBatteryBtn" class="btn btn-pill btn-outline-secondary" type="button">Old
                                    Battery</button>
                                <button id="repairBatteryBtn" class="btn btn-pill btn-outline-success" type="button">Repair
                                    Battery</button>
                                <button id="replacementBatteryBtn" class="btn btn-pill btn-info" type="button">Replacement
                                    Battery</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-9 col-xl-8">
                <div class="row">
                    <div class="col-xl-12">


                        <div class="card">
                            <div class="card-header card-no-border">
                                <div class="header-top">
                                    <h5>All battery Brands</h5>
                                    <div class="card-header-right-btn">
                                        <a class="font-dark f-12" href="javascript:void(0)" id="viewAllBrands"
                                            data-bs-toggle="modal" data-bs-target="#dashboard83">
                                            View All
                                        </a>

                                    </div>
                                </div>

                                <div class="modal fade" id="dashboard83" tabindex="-1" aria-labelledby="dashboard83"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modaldashboard3">All Battery Brands</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="text-start dark-sign-up">
                                                    <div class="modal-body">

                                                        <div id="formMessage3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="slider-wrapper arrow-round">
                                    <div class="swiper shop-category-slider">
                                        {{-- @if ($brands->isEmpty())
                                        <p>No lubricant brands found.</p>
                                    @else --}}
                                        <div class="swiper-wrapper">
                                            @foreach ($brands as $brand)
                                                <div class="swiper-slide">
                                                    <div class="shop-box">
                                                        <a class="" data-brand-id="{{ $brand->id }} href="#">

                                                            <img src="{{ asset('storage/' . $brand->image) }}"
                                                                alt="{{ $brand->brand_name }}" style="width:100px;">
                                                        </a>
                                                    </div>
                                                    <span
                                                        class="m-t-10 category-title f-w-500 text-gray">{{ $brand->brand_name }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- @endif --}}

                                    </div>
                                </div>
                            </div>
                        </div>




                    </div>



                    <div class="col-xl-12">

                        <div class="card">
                            <div class="card-header card-no-border">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="main-product-wrapper">
                                        <div class="product-header">
                                            <h5>Our Products</h5>
                                            <p class="f-m-light mt-1 text-gray f-w-500">
                                                Browse & Discover Thousands of products here!
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Search Bar -->
                                    <form id="search-form" class="d-flex mb-3">
                                        <input type="text" id="search-query" class="form-control"
                                            placeholder="Search products...">
                                        <button type="submit" class="btn btn-primary ms-2">Search</button>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body main-our-product">
                                <div class="row g-3 scroll-product" id="product-list">
                                    <!-- Displaying Batteries -->
                                    @foreach ($batteries as $battery)
                                        <div class="col-xxl-3 col-sm-4">
                                            <div class="our-product-wrapper h-100 widget-hover" dataId="{{ $battery->id }}"
                                                data-name="{{ $battery->model_name }}"
                                                data-price="{{ number_format($battery->selling_price, 2) }}"
                                                data-image="{{ asset('storage/' . $battery->image) }}">
                                                <div class="our-product-img">
                                                    <img src="{{ asset('storage/' . $battery->image) }}"
                                                        alt="{{ $battery->model_name }}">
                                                </div>
                                                <div class="our-product-content">
                                                    <h6 class="f-14 f-w-500 pt-2 pb-1">{{ $battery->model_name }}</h6>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="txt-primary">RS
                                                            {{ number_format($battery->selling_price, 2) }}</h6>
                                                        <div class="add-quantity btn border text-gray f-12 f-w-500">
                                                            <i class="fa fa-minus remove-minus count-decrease"></i>
                                                            <button class="btn add-btn btn-sm p-1  ">Add</button>
                                                            <i class="fa fa-plus count-increase"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>






            <div class="col-xxl-3 col-md-4 customer-sidebar-left">
                <div class="md-sidebar h-100"><a class="btn btn-primary md-sidebar-toggle"
                        href="javascript:void(0)">Order
                        Details</a>
                    <div class="md-sidebar-aside custom-scrollbar responsive-order-details">
                        <div class="card customer-sticky">
                            <div class="card-header card-no-border pb-3">
                                <div class="header-top border-bottom pb-3">
                                    <h5 class="m-0">Customer </h5>






                                </div>
                            </div>
                            <div class="card-body pt-0 order-details">
                                <select class="form-select f-w-400 f-14 text-gray py-2" aria-label="Select Customer"
                                    id="customer-select" required onchange="loadCustomerOrders()">
                                    <option value="" selected disabled>Select Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">
                                            {{ $customer->phone_number }} - {{ $customer->first_name }}
                                            {{ $customer->last_name }}
                                        </option>
                                    @endforeach
                                </select>

                                <h5 class="m-0">Customer's Orders</h5>

                                <select class=" form-select f-w-400 f-14 text-gray py-2" aria-label="Select Order Id"
                                    id="order-select" required>
                                    <option value="" selected disabled>Select Order Id</option>
                                </select>

                                <h5 class="m-0">Order Items</h5>

                                <select class=" form-select f-w-400 f-14 text-gray py-2" aria-label="Select Order Item"
                                    id="order-item-select" required>
                                    <option value="" selected disabled>Select Order Item</option>
                                </select>

                                <style>
                                    .order-quantity {
                                        max-height: 400px;
                                        overflow-y: auto;
                                        border: 1px solid #ddd;
                                        padding: 10px;
                                        margin-bottom: 20px;
                                    }

                                    .order-history {
                                        max-height: 400px;
                                        overflow-y: auto;
                                        border: 1px solid #ddd;
                                        padding: 10px;
                                        margin-bottom: 20px;
                                    }


                                    .order-history::-webkit-scrollbar {
                                        width: 8px;
                                    }

                                    .order-quantity::-webkit-scrollbar {
                                        width: 8px;
                                    }

                                    .order-quantity::-webkit-scrollbar-thumb {
                                        background-color: #888;
                                        border-radius: 4px;
                                        /* Round the corners of the thumb */
                                    }

                                    .order-history::-webkit-scrollbar-thumb {
                                        background-color: #888;
                                        border-radius: 4px;
                                        /* Round the corners of the thumb */
                                    }

                                    .order-history::-webkit-scrollbar-thumb:hover {
                                        background-color: #555;
                                        /* Change color on hover */
                                    }

                                    .order-quantity::-webkit-scrollbar-thumb:hover {
                                        background-color: #555;
                                        /* Change color on hover */
                                    }
                                </style>

                                <div class="order-history p-b-20 border-bottom mt-3" id="order-history">

                                    <!-- Order details will be loaded here -->

                                </div>

                                <h5 class="m-0">Order Details</h5>



                                <div class="order-quantity p-b-20 border-bottom">



                                </div>






                                <div class="total-item">
                                    <div class="item-number"><span class="text-gray">Item</span><span class="f-w-500">0
                                            (Items)</span></div>
                                    <div class="item-number"><span class="text-gray">Subtotal</span><span
                                            class="f-w-500">0</span></div>
                                    <div class="item-number border-bottom"><span class="text-gray">Fees</span><span
                                            class="f-w-500">0</span></div>
                                    <div class="item-number pt-3 pb-0"><span class="f-w-500">Total</span>
                                        <h6 class="txt-primary">0</h6>
                                    </div>
                                </div>



                                <!-- Modal for Adding Old Battery -->
                                <div class="modal fade" id="dashboard82" tabindex="-1" aria-labelledby="dashboard82"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modaldashboard2">Add Old Battery</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <div class="text-start dark-sign-up">
                                                    <div class="modal-body">
                                                        <form class="row g-3 needs-validation" id="oldBatteryForm"
                                                            novalidate>
                                                            @csrf
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="old_battery_type">Old
                                                                    Battery Type<span class="txt-danger">*</span></label>
                                                                <input class="form-control" id="old_battery_type"
                                                                    name="old_battery_type" type="text"
                                                                    placeholder="Enter old Battery Type" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="old_battery_condition">Old
                                                                    Battery Condition<span
                                                                        class="txt-danger">*</span></label>
                                                                <select name="old_battery_condition"
                                                                    id="old_battery_condition" class="form-select"
                                                                    required>
                                                                    <option value="" disabled selected>Select
                                                                        Condition</option>
                                                                    @foreach ($old_battery_conditions as $condition)
                                                                        <option value="{{ $condition }}">
                                                                            {{ $condition }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label class="form-label" for="old_battery_value">Old
                                                                    Battery Value<span class="txt-danger">*</span></label>
                                                                <input class="form-control old_battery_value"
                                                                    id="old_battery_value" name="old_battery_value"
                                                                    type="number" placeholder="Value" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label" for="old_battery_value">Old
                                                                    Battery Quantity<span
                                                                        class="txt-danger">*</span></label>
                                                                <input class="form-control old_battery_quantity"
                                                                    id="old_battery_quantity" name="old_battery_quantity"
                                                                    type="number" placeholder="Quantity" required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label class="form-label" for="notes">Notes<span
                                                                        class="txt-danger"></span></label>
                                                                <textarea name="notes" placeholder="Type here" class="form-control" id="notes" required></textarea>
                                                            </div>
                                                            <div class="col-md-12 d-flex justify-content-end">
                                                                <button class="btn btn-primary" type="button"
                                                                    id="submitOldBatteryForm">Add</button>
                                                            </div>
                                                        </form>
                                                        <div id="formMessage" class="mt-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form id="order-form" method="POST"
                                    action="{{ route('replacements.storeReplacement') }}">
                                    @csrf

                                    <div class="widget-hover">
                                        <h5 class="m-0 p-t-40">Replace Details</h5>
                                        <div class="mb-4">
                                            <label for="price_adjustment" class="form-label">Replace Battery Price</label>
                                            <input type="number" id="price_adjustment" name="price_adjustment"
                                                class="form-control" placeholder="" readonly />
                                        </div>

                                        <div class="mb-4">
                                            <label for="replacement_reason" class="form-label">Replacement Reason</label>
                                            <select id="replacement_reason" name="replacement_reason" class="form-select"
                                                required>
                                                @foreach ($replacementReasons as $replacementReason)
                                                    <option value="{{ $replacementReason }}">{{ $replacementReason }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="widget-hover">
                                        <h5 class="m-0 p-t-40">Payment Section</h5>

                                        <div class="mb-4">
                                            <label for="total_price" class="form-label">Total Price</label>
                                            <input type="number" id="total_price" name="total_price"
                                                class="form-control" placeholder="Total Price" readonly />
                                        </div>

                                        <div class="mb-4">
                                            <label for="discount" class="form-label">Discount</label>
                                            <input type="number" id="discount" name="discount" class="form-control"
                                                step="0.01" placeholder="Enter discount" />
                                        </div>

                                        <!-- Old Battery Discount Section -->
                                        <div class="widget-hover">
                                            <h6 class="m-0 p-t-40">Old Battery Discount</h6>
                                            <div class="header-top pb-3">
                                                <div class="mb-4 card-header-right-icon create-right-btn">
                                                    <a class="btn btn-light-primary f-w-500 f-12"
                                                        href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#dashboard82">
                                                        Add Old Battery
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="old_battery_discount" class="form-label">Old Battery
                                                    Discount</label>
                                                <input type="number" id="old_battery_discount"
                                                    name="old_battery_discount" class="form-control"
                                                    placeholder="Old Battery Discount" value="0" readonly />
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="paid_amount" class="form-label">Paid Amount</label>
                                            <input type="number" id="paid_amount" name="paid_amount"
                                                class="form-control" step="0.01" placeholder="Enter price" />
                                        </div>
                                        <div class="mb-4">
                                            <label for="due_amount" class="form-label">Due Amount</label>
                                            <input type="number" id="due_amount" name="due_amount" class="form-control"
                                                step="0.01" placeholder="Due Amount" readonly />
                                        </div>
                                        <div class="mb-4">
                                            <label for="payment_type" class="form-label">Payment Type</label>
                                            <select id="payment_type" name="payment_type" class="form-select" required>
                                                @foreach ($paymentTypes as $paymentType)
                                                    <option value="{{ $paymentType }}">{{ $paymentType }}</option>
                                                @endforeach

                                                @foreach ($DBPaymentTypes as $paymentType)
                                                    <option value="{{ $paymentType->id }}">{{ $paymentType->name }}
                                                    </option>
                                                @endforeach

                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div id="cheque_fields" style="display: none;">
                                            <div class="mb-4">
                                                <label for="cheque_number" class="form-label">Cheque Number</label>
                                                <input type="text" id="cheque_number" name="cheque_number"
                                                    class="form-control" placeholder="Enter cheque number" />
                                            </div>

                                            <div class="mb-4">
                                                <label for="cheque_date" class="form-label">Cheque Date</label>
                                                <input type="date" id="cheque_date" name="cheque_date"
                                                    class="form-control" placeholder="Enter cheque date" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Additional Combo Boxes in Payment Section -->
                                    <div class="mb-4" hidden>
                                        <label for="tax_option" class="form-label">Tax</label>
                                        <select id="tax_option" name="tax_option" class="form-select">
                                            <option value="exclude"selected>
                                                Tax Exclude
                                            </option>
                                            <option value="include">
                                                Tax Include
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label for="tax_id" class="form-label">Tax (%)</label>
                                        <select id="tax_id" name="tax_id" class="form-select">
                                            <option value="" selected>Select Tax Percentage</option>
                                            @foreach ($taxes as $tax)
                                                <option value="{{ $tax->id }}">{{ $tax->percentage }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="need_tax_invoice" class="form-label">Need Tax Invoice</label>
                                        <select id="need_tax_invoice" name="need_tax_invoice" class="form-select">
                                            <option value="0" selected>No
                                            </option>
                                            <option value="1">Yes
                                            </option>
                                        </select>
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
                                    <div class="modal fade" id="taxModal" tabindex="-1"
                                        aria-labelledby="taxModalLabel" aria-hidden="true">
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
                                                            <label for="tax_percentage" class="form-label">Tax
                                                                Percentage</label>
                                                            <input type="number" id="tax_percentage"
                                                                name="tax_percentage" class="form-control"
                                                                placeholder="Enter tax percentage">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="modal_customer_name" class="form-label">Customer
                                                                Name</label>
                                                            <input type="text" id="modal_customer_name"
                                                                class="form-control" value="" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tax_holder_name" class="form-label">Tax Holder
                                                                Name</label>
                                                            <input type="text" id="tax_holder_name"
                                                                class="form-control" value="" readonly>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tax_number" class="form-label">Tax Number</label>
                                                            <input type="text" id="tax_number" class="form-control"
                                                                value="" readonly>
                                                        </div>
                                                        <div class="alert alert-warning" id="tax_warning"
                                                            style="display:none;">
                                                            You cannot add Tax, please select Or update the Customer.
                                                        </div>
                                                        <div id="formMessageTax"></div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="addTaxButton">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="place-order">


                                        <button id="place-order-btn"
                                            class="btn btn-primary btn-hover-effect w-100 f-w-500" type="submit">Place
                                            Order</button>

                                        <br />
                                        <br />

                                        <div class="mb-4">
                                            <label for="company_details" class="form-label">Company Details</label>
                                            <select id="company_details" name="company_details" class="form-select"
                                                required>
                                                @foreach ($companyDetails as $companyDetail)
                                                    <option value="{{ $companyDetail->id }}">
                                                        {{ $companyDetail->company_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </form>

                                <!-- Modal -->
                                <div class="modal fade" id="PaymentTypeModel" tabindex="-1"
                                    aria-labelledby="PaymentTypeModelLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="row mt-3 mx-3">
                                                <div class="col-sm-8">
                                                    <h5 class="modal-title" id="PaymentTypeModelLabel">Enter Other
                                                        Option</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                    <a href="{{ route('purchases_type.create') }}" target="_blank">
                                                        <button type="button" class="btn btn-primary">Create
                                                            +</button>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>

                                            <form action="{{ route('purchases_type.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label for="name" class="form-label">Payment Type Name</label>
                                                    <input type="text" name="name" id="name"
                                                        class="form-control" placeholder="Enter Payment Type">
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
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

        <!-- Tax Combo Box & Modal Script -->
        <script>
            // Show modal when "Tax Include" is selected
            document.getElementById('tax_option').addEventListener('change', function() {
                if (this.value === 'include') {
                    var taxModal = new bootstrap.Modal(document.getElementById('taxModal'));
                    taxModal.show();
                    // Get selected customer ID from the dropdown
                    const customerId = document.getElementById("customer-select").value;

                    if (customerId == "") {

                        document.getElementById('tax_warning').style.display = 'block';
                        document.getElementById('addTaxButton').disabled = true;
                        return;
                    }

                    // You need to fetch the customer's tax information from your backend
                    if (customerId) {
                        fetch(`/admin/pos/customers/${customerId}/tax-info`)
                            .then(response => response.json())
                            .then(data => {
                                // Update modal fields with retrieved customer data
                                document.getElementById('modal_customer_name').value = data.customer_name;
                                document.getElementById('tax_holder_name').value = data.tax_holder_name || '';
                                document.getElementById('tax_number').value = data.tax_number || '';

                                // Update the warning display based on tax details
                                if (!data.tax_holder_name || !data.tax_number) {
                                    document.getElementById('tax_warning').style.display = 'block';
                                    document.getElementById('addTaxButton').disabled = true;
                                } else {
                                    document.getElementById('tax_warning').style.display = 'none';
                                    document.getElementById('addTaxButton').disabled = false;
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching customer tax info:', error);
                                // Clear the fields on error
                                document.getElementById('modal_customer_name').value = '';
                                document.getElementById('tax_holder_name').value = '';
                                document.getElementById('tax_number').value = '';
                                document.getElementById('tax_warning').style.display = 'block';
                                document.getElementById('addTaxButton').disabled = true;
                            });
                    } else {
                        // Clear the fields if no customer is selected
                        document.getElementById('modal_customer_name').value = '';
                        document.getElementById('tax_holder_name').value = '';
                        document.getElementById('tax_number').value = '';
                    }

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

                }
            });

            $(document).ready(function() {
                // Initialize Select2
                $('#customer-select').select2();

                // Attach change event using jQuery
                $('#customer-select').on('change', function() {
                    const customerId = this.value;

                    if (customerId == "") {

                        document.getElementById('tax_id').disabled = true;
                        return;
                    } else {
                        document.getElementById('tax_id').disabled = false;
                    }


                    if (customerId) {
                        fetch(`/admin/pos/customers/${customerId}/tax-info`)
                            .then(response => response.json())
                            .then(data => {
                                // Update modal fields with retrieved customer data
                                document.getElementById('modal_customer_name').value = data.customer_name;
                                document.getElementById('tax_holder_name').value = data.tax_holder_name ||
                                    '';
                                document.getElementById('tax_number').value = data.tax_number || '';

                                // Update the warning display based on tax details
                                if (!data.tax_holder_name || !data.tax_number) {
                                    document.getElementById('tax_warning').style.display = 'block';
                                    document.getElementById('addTaxButton').disabled = true;
                                    document.getElementById('tax_id').value = '';
                                    document.getElementById('tax_id').disabled = true;
                                } else {
                                    document.getElementById('tax_warning').style.display = 'none';
                                    document.getElementById('addTaxButton').disabled = false;
                                    document.getElementById('tax_id').disabled = false;
                                }
                            })
                            .catch(error => {
                                console.error('Error fetching customer tax info:', error);
                                // Clear the fields on error
                                document.getElementById('modal_customer_name').value = '';
                                document.getElementById('tax_holder_name').value = '';
                                document.getElementById('tax_number').value = '';
                                document.getElementById('tax_warning').style.display = 'block';
                                document.getElementById('addTaxButton').disabled = true;
                                document.getElementById('tax_id').value = '';
                                document.getElementById('tax_id').disabled = true;
                            });
                    } else {
                        // Clear the fields if no customer is selected
                        document.getElementById('modal_customer_name').value = '';
                        document.getElementById('tax_holder_name').value = '';
                        document.getElementById('tax_number').value = '';
                    }
                });
            });
        </script>

        <!-- JavaScript for Fetch -->
        <script>
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

            document.getElementById('viewAllBrands').addEventListener('click', function() {
                fetch('/api/brands') // Replace with your actual route
                    .then(response => response.json())
                    .then(data => {
                        const formMessage = document.getElementById('formMessage3');
                        formMessage.innerHTML = ''; // Clear existing content

                        if (data.length === 0) {
                            formMessage.innerHTML = '<p>No brands available.</p>';
                        } else {
                            const brandsContainer = document.createElement('div');
                            brandsContainer.style.display = 'grid';
                            brandsContainer.style.gridTemplateColumns = 'repeat(3, 1fr)';
                            brandsContainer.style.gap = '20px';
                            brandsContainer.style.padding = '10px';

                            const brandsHTML = data.map(brand => `
                    <div class="brand-item" style="text-align: center;">
                        <div class="shop-box">
                            <a class="brand-link" data-brand-id="${brand.id}" href="#">
                                <img src="/storage/${brand.image}" alt="${brand.brand_name}" style="width: 100px;">
                            </a>
                        </div>
                        <span style="margin-top: 10px; font-weight: 500; color: gray;">${brand.brand_name}</span>
                    </div>
                `).join('');

                            brandsContainer.innerHTML = brandsHTML;
                            formMessage.appendChild(brandsContainer);

                            // Attach click event listeners to the dynamically loaded brand links
                            const brandLinks = document.querySelectorAll('.brand-link');
                            brandLinks.forEach(link => {
                                link.addEventListener('click', function(e) {
                                    e.preventDefault();

                                    // Get the brand ID from the clicked element
                                    const brandId = this.getAttribute('data-brand-id');

                                    // Send an AJAX request to fetch products by brand
                                    fetch(`/products-by-brand/${brandId}`)
                                        .then(response => response.text())
                                        .then(html => {
                                            // Update the product list container with the new products
                                            document.querySelector('.scroll-product')
                                                .innerHTML = html;

                                            // Close the modal
                                            const modal = document.getElementById(
                                                'dashboard83');
                                            const bootstrapModal = bootstrap.Modal.getInstance(
                                                modal);
                                            bootstrapModal.hide();
                                        })
                                        .catch(error => console.error('Error fetching products:',
                                            error));

                                    // Optionally recalculate totals if needed
                                    calculateTotals();
                                });
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching brands:', error);
                        document.getElementById('formMessage3').innerHTML =
                            '<p>Failed to load brands. Please try again later.</p>';
                    });
            });




            function loadCustomerOrders() {
                const customerId = document.getElementById("customer-select").value;
                const orderSelect = document.getElementById("order-select");
                const orderHistory = document.getElementById("order-history");

                // Clear the previous options and history
                orderSelect.innerHTML = '<option value="" selected disabled>Select Order Id</option>';
                orderHistory.innerHTML = '';

                // Send an AJAX request to fetch orders
                fetch(`/admin/replacement/get-customer-orders/${customerId}`)
                    .then(response => response.json())
                    .then(orders => {
                        if (orders.length > 0) {
                            // Populate the orders dropdown
                            orders.forEach(order => {
                                const option = document.createElement("option");
                                option.value = order.id;
                                option.textContent =
                                    `${order.order_id} - ${order.order_type} (${order.order_date})`;
                                orderSelect.appendChild(option);
                            });
                        } else {
                            // Show a message if no orders are found
                            orderHistory.innerHTML = '<p>No orders found for this customer.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching customer orders:', error);
                        orderHistory.innerHTML = '<p>An error occurred while fetching orders. Please try again later.</p>';
                    });
            }

            // Function to load order items into the dropdown
            function loadOrderItemsIntoDropdown(orderId) {
                const orderItemSelect = document.getElementById("order-item-select");

                // Reset the dropdown
                orderItemSelect.innerHTML = '<option value="" selected disabled>Select Order Item</option>';

                // Fetch order items
                fetch(`/admin/replacement/get-order-items/${orderId}`)
                    .then(response => response.json())
                    .then(order => {
                        if (order && order.items && order.items.length > 0) {
                            // Populate dropdown with items
                            order.items.forEach(item => {
                                const option = document.createElement('option');
                                option.value = JSON.stringify({
                                    battery_id: item.battery_id,
                                    quantity: item.quantity,
                                    price: item.price,
                                    image: item.image,
                                    name: item.name
                                });
                                option.textContent = `${item.name} (Qty: ${item.quantity})`;
                                orderItemSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error loading order items:", error);
                        orderItemSelect.innerHTML = '<option value="" disabled>Error loading items</option>';
                    });
            }

            // Function to display selected item details
            function displaySelectedItemDetails(itemData) {
                const orderHistory = document.getElementById("order-history");
                const item = JSON.parse(itemData);
                const imageUrl = `/storage/${item.image}`;
                const formattedPrice = parseFloat(item.price).toFixed(2);

                const customerOrderItem = `

                        <style>
                                    .customer-order-wrapper {
                                        display: flex;
                                        flex-wrap: wrap;
                                        justify-content: space-between;
                                        padding: 10px;
                                        border: 1px solid #ddd;
                                        margin-bottom: 15px;
                                        background-color: #fff;
                                        border-radius: 8px;
                                    }

                                    .left-details1 {
                                        flex: 1;
                                        padding-right: 10px;
                                    }

                                    .order-img1 img {
                                        width: 59px;
                                        height: 49px;
                                        object-fit: cover;
                                        border-radius: 5px;
                                    }

                                    .category-details1 {
                                        flex: 2;
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                    }

                                    .order-details-right1 {
                                        flex: 1;
                                        padding-left: 10px;
                                    }

                                    .f-141 {
                                        font-size: 14px;
                                    }

                                    .f-w-5001 {
                                        font-weight: 500;
                                    }

                                    .mb-31 {
                                        margin-bottom: 10px;
                                    }

                                    .battery-id1 {
                                        color: #333;
                                    }

                                    .last-order-detail1 {
                                        display: flex;
                                        justify-content: space-between;
                                        align-items: center;
                                    }

                                    .txt-primary1 {
                                        color: #007bff;
                                    }

                                    .item-price1 {
                                        font-size: 16px;
                                        font-weight: 600;
                                    }

                                    .trash-remove1 i {
                                        color: #ff4d4f;
                                        font-size: 18px;
                                        cursor: pointer;
                                    }

                                    .right-details1 {
                                        display: flex;
                                        align-items: center;
                                    }


                                    .btn-touchspin1 {
                                        background-color: #f0f0f0;
                                        border: 1px solid #ddd;
                                        padding: 5px 10px;
                                        cursor: pointer;
                                        font-size: 16px;
                                    }


                                    .decrement-touchspin1, .increment-touchspin1 {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                    }

                                    /* Hover effects */
                                    .trash-remove1:hover i {
                                        color: #d9534f;
                                    }

                                    .btn-touchspin1:hover {
                                        background-color: #e0e0e0;
                                    }

                                    .customer-order-wrapper:hover {
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                                    }

                                    .touchspin-wrapper1 {
                                        display: flex;
                                        justify-content: center;
                                        align-items: center;
                                        width: 100%; /* Ensure the parent container has full width */
                                        overflow: hidden; /* Prevent the input from overflowing */
                                    }

                                    .input-touchspin1 {
                                        width: 100%; /* Make the input take up the full width of its parent */
                                        max-width: 100px; /* Limit the max width of the input */
                                        text-align: center;
                                        border: 1px solid #ddd;
                                        padding: 5px;
                                        font-size: 14px;
                                        border-radius: 4px;
                                        box-sizing: border-box; /* Ensure padding is included in the element's total width */
                                        margin: 0;
                                    }

                                    /* Optional: Make the input field more responsive on small screens */
                                    @media (max-width: 576px) {
                                        .input-touchspin1 {
                                            max-width: 80px;
                                        }
                                    }
                                </style>

                    <div class="customer-order-wrapper">
                        <div class="left-details1">
                            <div class="order-img1 widget-hover">
                                <img src="${imageUrl}" alt="${item.name}" width="59" height="49">
                            </div>
                        </div>
                        <div class="category-details1 item-row">
                            <div class="order-details-right1">
                                <span class="text-gray mb-1">Category: <span class="font-dark">Product</span></span>
                                <h6 class="f-141 f-w-5001 mb-31 battery-id1" data-order-id="${item.battery_id}">${item.name}</h6>
                                <div class="last-order-detail1">
                                    <h6 class="txt-primary1 item-price1">RS${formattedPrice}</h6>
                                    <a href="javascript:void(0)" class="trash-remove1 trash-remove-product" data-order-id="${item.battery_id}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <div class="right-details1">
                                    <div class="touchspin-wrapper1">
                                        <input class="input-touchspin1 item-quantity1" type="number" value="${item.quantity}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                orderHistory.innerHTML = customerOrderItem;
            }

            let oldBatteryBackendData = null;

            document.getElementById("submitOldBatteryForm").addEventListener("click", async function(e) {
                e.preventDefault();

                // Get the form and its data
                const form = document.getElementById("oldBatteryForm");
                const formData = new FormData(form);

                // Get selected customer ID from the dropdown
                const customerSelect = document.getElementById("customer-select");
                const customerId = customerSelect.value;

                if (customerId == "") {
                    const messageContainer = document.getElementById("formMessage");
                    messageContainer.innerHTML =
                        `<div class="alert alert-danger">Please select a customer.</div>`;
                    return;
                }

                // Append customer ID to the form data
                formData.append("customer_id", customerId);

                try {
                    // Send data to the server using fetch
                    const response = await fetch("{{ route('pos.oldBatteryCreate') }}", {
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
                        oldBatteryBackendData = result.data;
                        document.getElementById("old_battery_discount").value = result.data.old_battery_value *
                            result.data.old_battery_quantity;
                        messageContainer.innerHTML =
                            `<div class="alert alert-success">Old battery added successfully!</div>`;
                        form.reset(); // Reset the form
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
        </script>

        <script>
            const csrfToken = "{{ csrf_token() }}";
            const placeOrderBtn = document.getElementById("place-order-btn");
            // console.log(placeOrderBtn); // Check if this logs the button element

            document.getElementById("place-order-btn").addEventListener("click", function(e) {
                e.preventDefault(); // Prevent form submission until fields are populated

                const orderId = document.querySelector("#order-select").value;

                // Get the values from the DOM
                const customerId = document.querySelector("#customer-select").value;
                if (customerId == "") {
                    alert("Please select a customer.");
                    return;
                }
                // Get the values from the DOM
                const companyId = document.querySelector("#company_details").value;
                if (companyId == "") {
                    alert("Please select or add a company.");
                    return;
                }

                if (!orderId) {
                    alert("Please select an order.");
                    return;
                }

                // Prepare the items array for current order items
                const items = [];
                const orderDetailsWrappers = document.querySelectorAll(".order-details-wrapper");
                orderDetailsWrappers.forEach(wrapper => {
                    const batteryId = wrapper.querySelector(".battery-id")?.getAttribute("data-id");
                    if (!batteryId) {
                        console.error("Invalid battery_id detected");
                        return;
                    }
                    const quantity = wrapper.querySelector(".input-touchspin")?.value || 0;
                    const priceText = wrapper.querySelector(".txt-primary")?.textContent || "0";
                    const price = priceText.replace("RS", "").replace(/,/g, "").trim();

                    if (batteryId && quantity > 0 && price) {
                        items.push({
                            battery_id: batteryId,
                            quantity: parseInt(quantity, 10),
                            price: parseFloat(price)
                        });
                    }
                });

                // Get customer's order history items
                const customerOrderItems = [];
                const orderHistoryWrappers = document.querySelectorAll(".customer-order-wrapper");

                orderHistoryWrappers.forEach(wrapper => {
                    const batteryId = wrapper.querySelector(".battery-id1")?.getAttribute("data-order-id");
                    const quantity = wrapper.querySelector(".input-touchspin1")?.value || 0;
                    const priceText = wrapper.querySelector(".txt-primary1")?.textContent || "0";
                    const price = priceText.replace("RS", "").replace(/,/g, "").trim();

                    if (batteryId && quantity > 0 && price) {
                        customerOrderItems.push({
                            battery_id: batteryId,
                            quantity: parseInt(quantity, 10),
                            price: parseFloat(price)
                        });
                    }
                });

                const totalItems = document.querySelector(".item-number:nth-child(1) .f-w-500")?.textContent.trim() ||
                    "0";
                const subtotal = document.querySelector(".item-number:nth-child(2) .f-w-500")?.textContent.trim() ||
                    "0";
                const totalPrice = document.querySelector(".item-number:nth-child(4) h6")?.textContent.trim() || "0";
                const paidAmount = document.querySelector("#paid_amount").value || 0;
                const paymentType = document.querySelector("#payment_type").value;
                const discount = document.querySelector("#discount").value || 0;
                const oldBatteryDiscount = document.querySelector("#old_battery_discount").value || 0;

                // Ensure proper formatting and parsing of values
                const subtotalValue = parseFloat(subtotal.replace("RS", "").replace(",", "").trim()) || 0;
                const totalPriceValue = parseFloat(totalPrice.replace("RS", "").replace(",", "").trim()) || 0;
                const paidAmountValue = parseFloat(paidAmount) || 0;
                const dueAmountValue = totalPriceValue - paidAmountValue;

                // Check if totalPrice is correctly calculated
                if (isNaN(totalPriceValue)) {
                    alert("Total price is not calculated correctly. Please check the totals.");
                    return; // Stop form submission if total price is invalid
                }

                // Get old battery details
                const oldBattery = {
                    type: document.getElementById("old_battery_type")?.value || null,
                    condition: document.getElementById("old_battery_condition")?.value || null,
                    value: document.getElementById("old_battery_value")?.value || null,
                    notes: document.getElementById("notes")?.value || null,
                };

                // Populate hidden fields in the form
                // document.getElementById("subtotal").value = subtotalValue;
                document.getElementById("total_price").value = totalPriceValue;
                document.getElementById("paid_amount").value = paidAmountValue;

                const subTotalInput = document.createElement("input");
                subTotalInput.type = "hidden";
                subTotalInput.name = "subtotal";
                subTotalInput.value = subtotalValue;
                document.getElementById("order-form").appendChild(subTotalInput);

                const total_items = document.createElement("input");
                total_items.type = "hidden";
                total_items.name = "total_items";
                total_items.value = totalItems.replace(" (Items)", "").trim();
                document.getElementById("order-form").appendChild(total_items);

                const customer_id = document.createElement("input");
                customer_id.type = "hidden";
                customer_id.name = "customer_id";
                customer_id.value = customerId;
                document.getElementById("order-form").appendChild(customer_id);
                // document.getElementById("due_amount").value = dueAmountValue;
                document.getElementById("payment_type").value = paymentType;

                const battery_discount_input = document.createElement("input");
                battery_discount_input.type = "hidden";
                battery_discount_input.name = "battery_discount";
                battery_discount_input.value = discount;
                document.getElementById("order-form").appendChild(battery_discount_input);

                const old_battery_discount_value = document.createElement("input");
                old_battery_discount_value.type = "hidden";
                old_battery_discount_value.name = "old_battery_discount_value";
                old_battery_discount_value.value = oldBatteryDiscount;
                document.getElementById("order-form").appendChild(old_battery_discount_value);

                const companyInput = document.createElement("input");
                companyInput.type = "hidden";
                companyInput.name = "company_details";
                companyInput.value = companyId;
                document.getElementById("order-form").appendChild(companyInput);

                const orderIdInput = document.createElement("input");
                orderIdInput.type = "hidden";
                orderIdInput.name = "order_id";
                orderIdInput.value = orderId;
                document.getElementById("order-form").appendChild(orderIdInput);

                // Add the items details to the form as a hidden input
                const itemsInput = document.createElement("input");
                itemsInput.type = "hidden";
                itemsInput.name = "items";
                itemsInput.value = JSON.stringify(items); // Convert items array to JSON string
                document.getElementById("order-form").appendChild(itemsInput);


                // Include old battery data as hidden input
                const oldBatteryInput = document.createElement("input");
                oldBatteryInput.type = "hidden";
                oldBatteryInput.name = "old_battery";
                oldBatteryInput.value = JSON.stringify(oldBatteryBackendData);
                document.getElementById("order-form").appendChild(oldBatteryInput);

                // Add customer order items to the form as hidden input
                const customerOrderInput = document.createElement("input");
                customerOrderInput.type = "hidden";
                customerOrderInput.name = "customer_order_items";
                customerOrderInput.value = JSON.stringify(customerOrderItems);
                document.getElementById("order-form").appendChild(customerOrderInput);

                // Submit the form after populating the hidden fields
                document.getElementById("order-form").submit();
            });

            document.addEventListener("DOMContentLoaded", function() {
                const placeOrderBtn = document.getElementById("place-order-btn");

                const totalPriceField = document.getElementById("total_price");
                const paidAmountField = document.getElementById("paid_amount");
                const dueAmountField = document.getElementById("due_amount");
                const oldBatteryDiscountValue = document.getElementById("old_battery_discount");
                const discountField = document.getElementById("discount");



                const orderCardContainer = document.querySelector(".order-quantity");
                const orderHistory = document.querySelector(".order-history");
                const totalItemElement = document.querySelector(".total-item");

                // When the Add button is clicked in the modal, calculate and display Total Amount Including Tax
                document.getElementById('addTaxButton').addEventListener('click', async function(e) {
                    e.preventDefault();

                    const formData = new FormData();

                    const customerId = document.getElementById("customer-select").value;

                    if (customerId == "") {
                        const messageContainer = document.getElementById("formMessageTax");
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
                        const messageContainer = document.getElementById("formMessageTax");
                        if (response.ok) {

                            // Immediately recalc overall totals to reflect the new tax amount
                            calculateTotals();
                            document.getElementById("tax_id").value = result.data.id;
                            var taxModal = bootstrap.Modal.getInstance(document.getElementById('taxModal'));
                            taxModal.hide();
                        } else {
                            messageContainer.innerHTML =
                                `<div class="alert alert-danger">${result.message || "Something went wrong!"}</div>`;
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        const messageContainer = document.getElementById("formMessageTax");
                        messageContainer.innerHTML =
                            `<div class="alert alert-danger">An error occurred. Please try again.</div>`;
                    }



                });


                // When the Add button is clicked in the modal, calculate and display Total Amount Including Tax
                document.getElementById('tax_id').addEventListener('change', function(e) {
                    e.preventDefault();

                    const customerId = document.getElementById("customer-select").value;

                    if (customerId == "") {
                        alert("Please select a customer.");
                        this.value = "";
                        return;
                    }

                    // Immediately recalc overall totals to reflect the new tax amount
                    calculateTotals();

                });

                document.getElementById("order-select").addEventListener("change", function() {
                    const orderId = this.value;
                    if (orderId) {
                        loadOrderItemsIntoDropdown(orderId);
                        // Clear the order history when a new order is selected
                        document.getElementById("order-history").innerHTML = '';
                    }
                });

                // Event listener for order item selection
                document.getElementById("order-item-select").addEventListener("change", function() {
                    const selectedItem = this.value;
                    if (selectedItem) {
                        displaySelectedItemDetails(selectedItem);
                        calculateAdjestment();
                        calculateTotals();
                    }
                });

                calculateTotals();
                calculateAdjestment();

                // Event delegation for increment, decrement, and remove buttons in the order details
                orderHistory.addEventListener("click", function(event) {
                    const target = event.target;

                    if (target.closest(".trash-remove-product")) {
                        // Remove item
                        const customerOrderItem = target.closest(".customer-order-wrapper");
                        customerOrderItem.remove();
                        calculateAdjestment();
                        calculateTotals();
                        // Show empty cart message if no items are left
                        if (!document.querySelectorAll(".customer-order-wrapper").length) {
                            document.querySelector(".empty-card").style.display = "block";
                        }
                        // Recalculate totals

                    }
                });



                // Function to format price based on conditions
                function formatPrice(price) {
                    return new Intl.NumberFormat('en-US').format(parseFloat(price || 0));
                }

                function calculateAdjestment() {
                    let adjestment = 0; // Initialize adjustment to 0

                    // Iterate through all customer-order-wrapper elements
                    document.querySelectorAll(".customer-order-wrapper").forEach(customerOrderItem => {
                        const quantityInput = customerOrderItem.querySelector(".input-touchspin1");
                        const priceTextElement = customerOrderItem.querySelector(".txt-primary1");

                        // Parse quantity and price
                        const quantity = parseInt(quantityInput?.value ||
                            0); // Use 0 as default if value is null/undefined
                        const priceText = priceTextElement?.textContent.replace("RS", "").trim() || "0";
                        const price = parseFloat(priceText); // Ensure proper parsing of price

                        if (!isNaN(quantity) && !isNaN(price)) {
                            adjestment += quantity * price; // Accumulate adjustment
                        }
                    });

                    // Format adjustment value
                    const formattedAdjestment = adjestment.toFixed(2); // Use `toFixed(2)` for 2 decimal places

                    // Get the adjustment field
                    const adjestmentField = document.getElementById("price_adjustment");

                    if (adjestmentField) {
                        adjestmentField.value = formattedAdjestment; // Set adjustment value to the input field
                    } else {
                        console.error("Adjustment field not found! Ensure #price_adjustment exists in the DOM.");
                    }
                }



                // Function to calculate totals
                function calculateTotals() {
                    const oldBatteryDiscount = parseFloat(document.getElementById("old_battery_discount").value || 0);
                    const discount = parseFloat(document.getElementById("discount").value || 0);
                    let totalItems = 0;
                    let baseSubtotal = 0;
                    const fee = 0;

                    // Calculate from current order items
                    document.querySelectorAll(".order-details-wrapper").forEach(orderItem => {
                        const quantity = parseInt(orderItem.querySelector(".input-touchspin")?.value || 0);
                        const priceText = orderItem.querySelector(".txt-primary")?.textContent.replace("RS", "")
                            .replace(/,/g, "").trim();
                        const price = parseFloat(priceText || 0);

                        if (!isNaN(quantity) && !isNaN(price)) {
                            totalItems += quantity;
                            baseSubtotal += (quantity * price);
                        }
                    });

                    // Calculate from order history items
                    document.querySelectorAll(".customer-order-wrapper").forEach(historyItem => {
                        const quantity = parseInt(historyItem.querySelector(".input-touchspin1")?.value || 0);
                        const priceText = historyItem.querySelector(".txt-primary1")?.textContent.replace("RS",
                            "").replace(/,/g, "").trim();
                        const price = parseFloat(priceText || 0);

                        if (!isNaN(quantity) && !isNaN(price)) {
                            // totalItems += quantity;
                            baseSubtotal -= (quantity * price);
                        }
                    });

                    let total = baseSubtotal + fee;
                    let subtotal = baseSubtotal + fee - discount - oldBatteryDiscount;

                    // Now, check if tax should be applied
                    const taxOption = document.getElementById("tax_option").value;


                    let taxSelect = document.getElementById('tax_id');
                    let selectedOption = taxSelect.options[taxSelect.selectedIndex];
                    let taxPercentage1 = selectedOption.textContent.trim();


                    const taxPercentage = parseFloat(document.getElementById("tax_percentage").value || 0);
                    let taxAmount = 0;
                    if (taxOption === "include" && taxPercentage > 0) {
                        // Calculate tax on the current subtotal
                        taxAmount = total * (taxPercentage / 100);
                        // Update hidden field for tax_paid so it can be displayed if needed
                        document.getElementById("tax_paid").value = taxAmount.toFixed(2);
                        // Add tax to the subtotal
                        subtotal += taxAmount;
                    } else if (taxSelect.value != "") {
                        taxAmount = subtotal * (taxPercentage1 / 100);
                        // Update hidden field for tax_paid so it can be displayed if needed
                        document.getElementById("tax_paid").value = taxAmount.toFixed(2);
                        // Add tax to the subtotal
                        subtotal += taxAmount;
                    } else {
                        document.getElementById("tax_paid").value = "0.00";
                    }

                    // Calculate final totals
                    total = baseSubtotal + fee + taxAmount;;

                    // Format numbers for display
                    const formattedSubtotal = formatPrice(subtotal);
                    const formattedFee = formatPrice(fee);
                    const formattedTotal = formatPrice(total);

                    // Update DOM elements
                    const totalItemElement = document.querySelector(".total-item");
                    if (totalItemElement) {
                        totalItemElement.querySelector(".item-number:nth-child(1) .f-w-500").textContent =
                            `${totalItems} (Items)`;
                        totalItemElement.querySelector(".item-number:nth-child(2) .f-w-500").textContent =
                            `RS${formattedSubtotal}`;
                        totalItemElement.querySelector(".item-number:nth-child(3) .f-w-500").textContent =
                            `RS${formattedFee}`;
                        totalItemElement.querySelector(".item-number:nth-child(4) h6").textContent =
                            `RS${formattedTotal}`;
                    }

                    // Update form fields
                    const totalPriceField = document.getElementById("total_price");
                    if (totalPriceField) {
                        totalPriceField.value = total.toFixed(2);
                    }

                    // Recalculate due amount
                    calculateDueAmount();

                }




                // Function to calculate due amount
                function calculateDueAmount() {
                    const totalPrice = parseFloat(totalPriceField.value || 0);
                    const paidAmount = parseFloat(paidAmountField.value || 0);
                    const oldBatteryDiscount = parseFloat(oldBatteryDiscountValue.value || 0);
                    const discount = parseFloat(discountField.value || 0);
                    // const adjestment = parseFloat(document.getElementById("price_adjustment").value || 0);
                    const dueAmount = totalPrice - (paidAmount + oldBatteryDiscount + discount);
                    dueAmountField.value = dueAmount.toFixed(2);
                }

                // Event listener for Paid Amount input field
                paidAmountField.addEventListener("input", calculateTotals);
                paidAmountField.addEventListener("input", calculateDueAmount);
                paidAmountField.addEventListener("input", calculateAdjestment);
                document.getElementById("discount").addEventListener("input", calculateTotals);
                document.getElementById("discount").addEventListener("input", calculateDueAmount);
                document.getElementById("discount").addEventListener("input", calculateAdjestment);
                document.getElementById("old_battery_discount").addEventListener("input", calculateTotals);
                document.getElementById("old_battery_discount").addEventListener("input", calculateDueAmount);
                document.getElementById("old_battery_discount").addEventListener("input", calculateAdjestment);
                document.getElementById("order-history").addEventListener("change", calculateAdjestment);
                document.getElementById("order-select").addEventListener("change", calculateAdjestment);

                const taxOptionSelect = document.getElementById('tax_option');
                taxOptionSelect.addEventListener('change', calculateTotals);

                // Event delegation for the Add button (works for dynamically added products too)
                document.querySelector('.scroll-product').addEventListener("click", function(event) {
                    const target = event.target;

                    // Check if the clicked target is an "Add" button
                    if (target.classList.contains("add-btn")) {

                        const productWrapper = target.closest(".our-product-wrapper");

                        // Extract product details from data attributes
                        const name = productWrapper.getAttribute("data-name");
                        const id = productWrapper.getAttribute("dataId");
                        const priceString = productWrapper.getAttribute("data-price");
                        const price = parseFloat(priceString.replace(/,/g, '')); // Remove commas before parsing
                        const formattedPrice = formatPrice(price); // Format price based on conditions
                        const image = productWrapper.getAttribute("data-image");

                        // Create an order card item
                        const orderItem = `
                                <div class="order-details-wrapper">
                                    <div class="left-details">
                                        <div class="order-img widget-hover">
                                            <img src="${image}" alt="${name}">
                                        </div>
                                    </div>
                                    <div class="category-details item-row">
                                        <div class="order-details-right">
                                            <span class="text-gray mb-1">Category: <span class="font-dark">Product</span></span>
                                            <h6 class="f-14 f-w-500 mb-3 battery-id" data-id="${id}">${name}</h6>
                                            <div class="last-order-detail">
                                                <h6 class="txt-primary item-price">RS${formattedPrice}</h6>
                                                <a href="javascript:void(0)" class="trash-remove"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <div class="right-details">
                                            <div class="touchspin-wrapper">
                                                <button class="decrement-touchspin btn-touchspin"><i class="fa fa-minus text-gray"></i></button>
                                                <input class="input-touchspin item-quantity" type="number" value="1" readonly>
                                                <button class="increment-touchspin btn-touchspin"><i class="fa fa-plus text-gray"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                        // Append the order item to the order card
                        orderCardContainer.insertAdjacentHTML("beforeend", orderItem);
                        // Recalculate totals
                        calculateTotals();
                        checkAndDisableAddButton();


                        // Hide "Your cart is empty" message
                        document.querySelector(".empty-card").style.display = "none";


                    }


                });

                // Function to check and disable Add button
                function checkAndDisableAddButton() {
                    console.log("Checking and disabling Add button...");
                    const totalItemElement = document.querySelector(".total-item");
                    const itemText = totalItemElement.querySelector(".item-number:nth-child(1) .f-w-500").textContent;

                    // Extract number from "X (Items)" format
                    const totalItems = parseInt(itemText.split('(')[0].trim());

                    // Get all add buttons
                    const addButtons = document.querySelectorAll('.add-btn');

                    // Disable/enable based on total items
                    if (totalItems === 1) {
                        addButtons.forEach(button => {
                            button.disabled = true;
                            button.classList.add('disabled'); // Optional: add a disabled class for styling
                        });
                    } else {
                        addButtons.forEach(button => {
                            button.disabled = false;
                            button.classList.remove('disabled');
                        });
                    }
                }

                // Event delegation for increment, decrement, and remove buttons in the order details
                orderCardContainer.addEventListener("click", function(event) {
                    const target = event.target;

                    if (target.closest(".increment-touchspin")) {
                        // Increment quantity
                        const input = target.closest(".touchspin-wrapper").querySelector(".input-touchspin");
                        input.value = parseInt(input.value) + 1;

                        // Recalculate totals
                        calculateTotals();
                    }

                    if (target.closest(".decrement-touchspin")) {
                        // Decrement quantity
                        const input = target.closest(".touchspin-wrapper").querySelector(".input-touchspin");
                        if (parseInt(input.value) > 1) {
                            input.value = parseInt(input.value) - 1;

                            // Recalculate totals
                            calculateTotals();
                        }
                    }

                    if (target.closest(".trash-remove")) {
                        // Remove item
                        const orderItem = target.closest(".order-details-wrapper");
                        orderItem.remove();

                        // Recalculate totals
                        calculateTotals();
                        checkAndDisableAddButton();

                        // Show empty cart message if no items are left
                        if (!document.querySelectorAll(".order-details-wrapper").length) {
                            document.querySelector(".empty-card").style.display = "block";
                        }


                    }
                });

                const brandLinks = document.querySelectorAll('.swiper-slide');

                brandLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Get the brand ID from the clicked element
                        const brandId = this.querySelector('a').getAttribute('data-brand-id');

                        // Send an AJAX request to fetch products by brand
                        fetch(`/products-by-brand/${brandId}`)
                            .then(response => response.text())
                            .then(html => {
                                // Update the product list container with the new products
                                document.querySelector('.scroll-product').innerHTML = html;
                            })
                            .catch(error => console.error('Error fetching products:', error));

                        calculateTotals();
                    });
                });

                calculateTotals();

                // Define the routes
                const routes = {
                    newBattery: "{{ route('POS.index') }}", // Replace with your actual route name
                    oldBattery: "{{ route('POS.index') }}", // Replace with your actual route name
                    repairBattery: "{{ route('POS.index') }}", // Replace with your actual route name
                    replacementBattery: "{{ route('replacements.index') }}" // Replacement Battery Route
                };

                // Event listeners for buttons
                document.getElementById('newBatteryBtn').addEventListener('click', function() {
                    window.location.href = routes.newBattery;
                });

                document.getElementById('oldBatteryBtn').addEventListener('click', function() {
                    window.location.href = routes.oldBattery;
                });

                document.getElementById('repairBatteryBtn').addEventListener('click', function() {
                    window.location.href = routes.repairBattery;
                });

                document.getElementById('replacementBatteryBtn').addEventListener('click', function() {
                    window.location.href = routes.replacementBattery;
                });

                const paymentTypeSelect = document.getElementById('payment_type');
                // Function to update fields when payment type is changed
                function updatePaymentFields() {
                    const paymentType = paymentTypeSelect.value;

                    // If payment type is Credit
                    if (paymentType === "Credit") {
                        paidAmountField.value = 0; // Set paid amount to 0
                        paidAmountField.setAttribute('readonly', true); // Make paid amount readonly
                        calculateDueAmount();
                    } else {
                        // If payment type is not Credit, reset the values and remove readonly
                        paidAmountField.removeAttribute('readonly');
                    }

                    // If payment type is "Other", show modal
                    if (paymentType === "Other") {
                        var modal = new bootstrap.Modal(document.getElementById("PaymentTypeModel"));
                        modal.show();
                    }
                }

                // Listen for changes to the payment type
                paymentTypeSelect.addEventListener('change', updatePaymentFields);
                updatePaymentFields();

                document.addEventListener("DOMContentLoaded", calculateTotals);
            });
        </script>


    </div>
    </div>
    <!-- Container-fluid Ends-->

@endsection

@section('script')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script src="{{ asset('assets/pos/js/custom_touchspin.js') }}"></script>
    <script src="{{ asset('assets/pos/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/pos/js/dashboard_8.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#customer-select').select2({
                placeholder: "Select Customer",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                let query = $('#search-query').val();

                $.ajax({
                    url: "{{ route('replacements.search') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('#product-list').html(response);
                    }
                });
            });
        });
    </script>

@endsection

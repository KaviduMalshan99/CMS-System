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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/old-battery-styles.css') }}">

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
                                <button class="btn btn-pill btn-outline-primary" type="button">New Battery</button>
                                <button class="btn btn-pill btn-outline-secondary" type="button">Old Battery</button>
                                <button class="btn btn-pill btn-outline-success" type="button">Repair Battery</button>
                                <button id="replacementBatteryBtn" class="btn btn-pill btn-outline-info" type="button">
                                    Replacement Battery
                                </button>
                                <button id="batteryOrdersBtn" class="btn btn-pill btn-outline-warning" type="button">
                                    All Battery Orders
                                </button>
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
                                <div class="main-product-wrapper">
                                    <div class="product-header">
                                        <h5>Our Products</h5>
                                        <p class="f-m-light mt-1 text-gray f-w-500">Browse & Discover Thousands of products
                                            here!</p>
                                    </div>
                                </div>

                                <input type="text" id="search-query" class="form-control"
                                    placeholder="Search products...">

                            </div>
                            <div class="card-body main-our-product">
                                <div class="row g-3 scroll-product">
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
                            <div class="card-header card-no-border">

                                <a href="{{ route('battery.quotations.index') }}"><button
                                        class="btn btn-pill btn-outline-primary mb-3 mx-2" type="button">
                                        All Battery quatation
                                    </button> </a>


                                <div class="header-top border-bottom pb-3">
                                    <h5 class="m-0">Customer </h5>
                                    <div class="card-header-right-icon create-right-btn"><a
                                            class="btn btn-light-primary f-w-500 f-12" href="javascript:void(0)"
                                            data-bs-toggle="modal" data-bs-target="#dashboard8">Create +</a></div>
                                    <!-- Modal-->
                                    <div class="modal fade" id="dashboard8" tabindex="-1" aria-labelledby="dashboard8"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modaldashboard">Create Customer</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-0">
                                                    <div class="text-start dark-sign-up">
                                                        <div class="modal-body">

                                                            <form class="row g-3 needs-validation"
                                                                action="{{ route('customer.create') }}" method="POST"
                                                                novalidate>
                                                                @csrf

                                                                <div class="col-md-12">
                                                                    <label class="form-label"
                                                                        for="validationCustomNic">NIC<span
                                                                            class="txt-danger"></span></label>
                                                                    <input class="form-control" id="validationCustomNic"
                                                                        name="nic" type="text" placeholder="Nic">
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="validationCustom-8">First
                                                                        Name<span class="txt-danger">*</span></label>
                                                                    <input class="form-control" id="validationCustom-8"
                                                                        name="first_name" type="text"
                                                                        placeholder="Enter your first name" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="validationCustom09">Last Name<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control" id="validationCustom09"
                                                                        name="last_name" type="text"
                                                                        placeholder="Enter your last name" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="validationCustom08">Mobile Number<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control" id="validationCustom08"
                                                                        name="phone_number" type="text"
                                                                        placeholder="Mobile number" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label"
                                                                        for="exampleFormControlInput8">Email<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control"
                                                                        id="exampleFormControlInput8" name="email"
                                                                        type="email"
                                                                        placeholder="customername@gmail.com">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label class="form-label"
                                                                        for="validationCustom08">Address<span
                                                                            class="txt-danger">*</span></label>
                                                                    <input class="form-control" id="validationCustom08"
                                                                        name="address" type="text"
                                                                        placeholder="Address" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="validationCustom-8">Tax
                                                                        Holder Name</label>
                                                                    <input class="form-control" id="validationCustom-8"
                                                                        name="tax_holder_name" type="text"
                                                                        placeholder="Type here" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label" for="validationCustom09">Tax
                                                                        Number</label>
                                                                    <input class="form-control" id="validationCustom09"
                                                                        name="tax_number" type="text"
                                                                        placeholder="Type here" required>
                                                                </div>
                                                                <div class="col-md-12 d-flex justify-content-end">
                                                                    <button class="btn btn-primary" type="submit">Create
                                                                        +</button>
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
                            <div class="card-body pt-0 order-details">
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

                                <h5 class="m-0">Order Details</h5>

                                <style>
                                    .order-quantity {
                                        max-height: 400px;
                                        overflow-y: auto;
                                        border: 1px solid #ddd;
                                        padding: 10px;
                                        margin-bottom: 20px;
                                    }


                                    .order-quantity::-webkit-scrollbar {
                                        width: 8px;
                                    }

                                    .order-quantity::-webkit-scrollbar-thumb {
                                        background-color: #888;
                                        border-radius: 4px;
                                        /* Round the corners of the thumb */
                                    }

                                    .order-quantity::-webkit-scrollbar-thumb:hover {
                                        background-color: #555;
                                        /* Change color on hover */
                                    }
                                </style>

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

                                <form id="order-form" method="POST" action="{{ route('POS.storeBatteryOrder') }}">
                                    @csrf
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




                                    <div class="place-order">


                                        <input type="hidden" name="customer_id" id="customer_id">
                                        <input type="hidden" name="total_items" id="total_items">
                                        <input type="hidden" name="subtotal" id="subtotal">
                                        <input type="hidden" name="battery_discount" id="battery_discount">
                                        <input type="hidden" name="order_type" id="order_type">
                                        <input type="hidden" name="old_battery_discount_value"
                                            id="old_battery_discount_value">
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
                                                        <label for="tax_percentage" class="form-label">Tax
                                                            Percentage</label>
                                                        <input type="number" id="tax_percentage" name="tax_percentage"
                                                            class="form-control" placeholder="Enter tax percentage">
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
                                                        <input type="text" id="tax_holder_name" class="form-control"
                                                            value="" readonly>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Option field outside the modal -->




        <!-- jQuery Script -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

                        // Create a hidden input field to hold the selected value
                        let taxSelect = document.getElementById('tax_id');
                        let hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'tax_id'; // Same name as the select field
                        hiddenInput.value = '';
                        // Append the hidden input inside the form
                        taxSelect.parentNode.appendChild(hiddenInput);
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

                                    // Create a hidden input field to hold the selected value
                                    let taxSelect = document.getElementById('tax_id');
                                    let hiddenInput = document.createElement('input');
                                    hiddenInput.type = 'hidden';
                                    hiddenInput.name = 'tax_id'; // Same name as the select field
                                    hiddenInput.value = '';
                                    // Append the hidden input inside the form
                                    taxSelect.parentNode.appendChild(hiddenInput);
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

                                // Create a hidden input field to hold the selected value
                                let taxSelect = document.getElementById('tax_id');
                                let hiddenInput = document.createElement('input');
                                hiddenInput.type = 'hidden';
                                hiddenInput.name = 'tax_id'; // Same name as the select field
                                hiddenInput.value = '';
                                // Append the hidden input inside the form
                                taxSelect.parentNode.appendChild(hiddenInput);
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
            let oldBatteryBackendData = null;

            document.getElementById('replacementBatteryBtn').addEventListener('click', function() {
                window.location.href = "{{ route('replacements.index') }}";
            });

            document.getElementById('batteryOrdersBtn').addEventListener('click', function() {
                window.location.href = "{{ route('POS.batteryOrder') }}";
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

                                    let endpoint = ``;


                                    if (orderType == "New Order") {

                                        endpoint = `/products-by-brand/${brandId}`;
                                    } else if (orderType == "Repair") {
                                        endpoint = `/repair-products-by-brand/${brandId}`;

                                    }

                                    // Send an AJAX request to fetch products by brand
                                    fetch(endpoint)
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

            let orderType = "New Order"; // Initialize a variable to store the order type

            // Add event listeners to the buttons to update the orderType value
            document.querySelector(".btn-showcase").addEventListener("click", function(e) {
                if (e.target.matches(".btn-outline-primary")) {
                    orderType = "New Order";
                } else if (e.target.matches(".btn-outline-secondary")) {
                    orderType = "Old Battery";
                } else if (e.target.matches(".btn-outline-success")) {
                    orderType = "Repair";
                }
            });

            const placeOrderBtn = document.getElementById("place-order-btn");
            // console.log(placeOrderBtn); // Check if this logs the button element

            document.getElementById("place-order-btn").addEventListener("click", function(e) {
                e.preventDefault(); // Prevent form submission until fields are populated

                // Get the values from the DOM
                const customerId = document.querySelector("#customer-select").value;
                if (customerId == "") {
                    alert("Please select a customer.");
                    return;
                }
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
                if (isNaN(totalPriceValue) || totalPriceValue === 0) {
                    alert("Total price is not calculated correctly. Please check the totals.");
                    return; // Stop form submission if total price is invalid
                }

                // Prepare the items array
                const items = [];
                const itemRows = document.querySelectorAll(
                    ".item-row"); // Replace with actual class or selector for item rows
                itemRows.forEach(row => {
                    const batteryId = row.querySelector(".battery-id").getAttribute("data-id");
                    const quantity = row.querySelector(".item-quantity")?.value || 0;
                    const price = row.querySelector(".item-price")?.textContent.trim().replace("RS", "")
                        .replace(",", "").trim() || "0";

                    if (orderType == "New Order") {
                        if (batteryId && quantity > 0 && price) {
                            items.push({
                                battery_id: batteryId,
                                quantity: parseInt(quantity, 10),
                                price: parseFloat(price)
                            });
                        }
                    } else if (orderType == "Old Battery") {
                        if (batteryId && quantity > 0 && price) {
                            items.push({
                                old_battery_id: batteryId,
                                quantity: parseInt(quantity, 10),
                                price: parseFloat(price)
                            });
                        }

                    } else if (orderType == "Repair") {
                        if (batteryId && quantity > 0 && price) {
                            items.push({
                                repair_battery_id: batteryId,
                                quantity: parseInt(quantity, 10),
                                price: parseFloat(price)
                            });
                        }

                    }

                });

                // Get old battery details
                const oldBattery = {
                    type: document.getElementById("old_battery_type")?.value || null,
                    condition: document.getElementById("old_battery_condition")?.value || null,
                    value: document.getElementById("old_battery_value")?.value || null,
                    notes: document.getElementById("notes")?.value || null,
                };

                // Populate hidden fields in the form
                document.getElementById("customer_id").value = customerId;
                document.getElementById("total_items").value = totalItems.replace(" (Items)", "").trim();
                document.getElementById("subtotal").value = subtotalValue;
                document.getElementById("total_price").value = totalPriceValue;
                document.getElementById("paid_amount").value = paidAmountValue;
                // document.getElementById("due_amount").value = dueAmountValue;
                document.getElementById("payment_type").value = paymentType;
                document.getElementById("battery_discount").value = discount;
                document.getElementById("old_battery_discount_value").value = oldBatteryDiscount;
                document.getElementById("order_type").value = orderType;

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
                        // Create a hidden input field to hold the selected value
                        let taxSelect = document.getElementById('tax_id');
                        let hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = 'tax_id'; // Same name as the select field
                        hiddenInput.value = '';
                        // Append the hidden input inside the form
                        taxSelect.parentNode.appendChild(hiddenInput);
                        return;
                    }

                    // Immediately recalc overall totals to reflect the new tax amount
                    calculateTotals();

                });

                calculateTotals();
                // Function to format price based on conditions
                function formatPrice(price) {
                    if (typeof price === "number") {
                        return new Intl.NumberFormat('en-US').format(price);
                    } else {
                        throw new Error("Input must be a number");
                    }
                }

                // Function to calculate totals
                function calculateTotals() {
                    const oldBatteryDiscount = parseFloat(oldBatteryDiscountValue.value || 0);
                    const discount = parseFloat(discountField.value || 0);
                    let totalItems = 0;
                    let subtotal = 0;
                    const fee = 0; // Example fixed fee

                    document.querySelectorAll(".order-details-wrapper").forEach(orderItem => {
                        const quantity = parseInt(orderItem.querySelector(".input-touchspin").value);
                        const priceText = orderItem.querySelector(".txt-primary").textContent.replace("RS", "")
                            .replace(",", "").trim();
                        const price = parseFloat(priceText); // Ensure proper parsing of price

                        totalItems += quantity;
                        subtotal += quantity * price
                    });

                    // Now, check if tax should be applied
                    const taxOption = document.getElementById("tax_option").value;

                    let taxSelect = document.getElementById('tax_id');
                    let selectedOption = taxSelect.options[taxSelect.selectedIndex];
                    let taxPercentage1 = selectedOption.textContent.trim();

                    const taxPercentage = parseFloat(document.getElementById("tax_percentage").value || 0);
                    let taxAmount = 0;
                    if (taxOption === "include" && taxPercentage > 0) {
                        // Calculate tax on the current subtotal
                        taxAmount = subtotal * (taxPercentage / 100);
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

                    subtotal -= (discount + oldBatteryDiscount);

                    const formattedSubtotal = formatPrice(subtotal);
                    const formattedFee = formatPrice(fee);
                    const formattedTotal = formatPrice(subtotal + fee + discount + oldBatteryDiscount);

                    // Update totals in the DOM
                    totalItemElement.querySelector(".item-number:nth-child(1) .f-w-500").textContent =
                        `${totalItems} (Items)`;
                    totalItemElement.querySelector(".item-number:nth-child(2) .f-w-500").textContent =
                        `RS${formattedSubtotal}`;
                    totalItemElement.querySelector(".item-number:nth-child(3) .f-w-500").textContent =
                        `RS${formattedFee}`;
                    totalItemElement.querySelector(".item-number:nth-child(4) h6").textContent = `RS${formattedTotal}`;

                    totalPriceField.value = subtotal + fee + oldBatteryDiscount + discount;
                    calculateDueAmount();
                }




                // Function to calculate due amount
                function calculateDueAmount() {
                    const totalPrice = parseFloat(totalPriceField.value || 0);
                    const paidAmount = parseFloat(paidAmountField.value || 0);
                    const oldBatteryDiscount = parseFloat(oldBatteryDiscountValue.value || 0);
                    const discount = parseFloat(discountField.value || 0);
                    const dueAmount = totalPrice - (paidAmount + oldBatteryDiscount + discount);


                    dueAmountField.value = dueAmount > 0 ? dueAmount.toFixed(2) : "0.00";
                }

                // Event listener for Paid Amount input field
                paidAmountField.addEventListener("input", calculateTotals);
                paidAmountField.addEventListener("input",
                    calculateDueAmount);
                document.getElementById("discount").addEventListener("input",
                    calculateTotals);
                document.getElementById("discount").addEventListener("input",
                    calculateDueAmount);
                document.getElementById("old_battery_discount").addEventListener("input",
                    calculateTotals);
                document.getElementById("old_battery_discount").addEventListener("input",
                    calculateDueAmount);

                // Event delegation for the Add button (works for dynamically added products too)
                document.querySelector('.scroll-product').addEventListener("click", function(event) {
                    const target = event.target;

                    // Check if the clicked target is an "Add" button
                    if (target.classList.contains("add-btn")) {
                        const productWrapper = target.closest(".our-product-wrapper");

                        // Ensure productWrapper is valid
                        if (!productWrapper) {
                            console.error("Product wrapper not found!");
                            return;
                        }

                        // Extract product details from data attributes
                        const name = productWrapper.getAttribute("data-name");
                        const id = productWrapper.getAttribute("dataId");
                        const priceString = productWrapper.getAttribute("data-price");
                        const price = parseFloat(priceString.replace(/,/g, '')); // Remove commas before parsing
                        const formattedPrice = formatPrice(price); // Format price based on conditions
                        const image = productWrapper.getAttribute("data-image");

                        // Check if it's an old battery by looking for the "Old Battery -" prefix in the name
                        const isOldBattery = name.startsWith("Old Battery -");
                        const isRepairBattery = name.startsWith("Repair Battery");

                        let orderItem;

                        if (isOldBattery) {
                            // Order item template for old batteries
                            orderItem = `
                                    <div class="order-details-wrapper old-battery-item">
                                        <div class="category-details item-row">
                                            <div class="order-details-right flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <span class="badge bg-warning mb-1">Old Battery</span>
                                                        <h6 class="f-14 f-w-500 mb-1 battery-id" data-id="${id}">${name}</h6>
                                                        <span class="text-gray d-block mb-2">
                                                            <small>Status: ${productWrapper.querySelector('.battery-status .badge:first-child')?.textContent || 'N/A'}</small>
                                                            <br>
                                                            <small>Condition: ${productWrapper.querySelector('.battery-status .badge:last-child')?.textContent || 'N/A'}</small>
                                                        </span>
                                                    </div>

                                                </div>
                                                <div class="last-order-detail d-flex justify-content-between align-items-center">
                                                    <h6 class="txt-primary item-price">RS${formattedPrice}</h6>
                                                    <a href="javascript:void(0)" class="trash-remove text-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
                                                <div class="touchspin-wrapper">
                                                    <button class="decrement-touchspin btn-touchspin">
                                                        <i class="fa fa-minus text-gray"></i>
                                                    </button>
                                                    <input class="input-touchspin item-quantity" type="number" value="1" readonly>
                                                    <button class="increment-touchspin btn-touchspin">
                                                        <i class="fa fa-plus text-gray"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                        } else if (isRepairBattery) {
                            // Extract product details from data attributes
                            const type = productWrapper.getAttribute("data-type");
                            const id = productWrapper.getAttribute("data-id");
                            const priceString = productWrapper.getAttribute("data-price");
                            const price = parseFloat(priceString.replace(/,/g,
                                '')); // Remove commas before parsing
                            const formattedPrice = formatPrice(price);

                            orderItem = `
                                <div class="order-details-wrapper repair-battery-item">
                                    <div class="category-details item-row">
                                        <div class="order-details-right flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <span class="badge bg-primary mb-1">Repair Battery</span>
                                                    <h6 class="f-14 f-w-500 mb-1 battery-id" data-id="${id}">${type}</h6>
                                                    <span class="text-gray d-block mb-2">
                                                        <small>Model: ${productWrapper.querySelector('.battery-details p').textContent.replace('Model: ', '')}</small>
                                                        <br>
                                                        <small>Stock: ${productWrapper.querySelector('.stock-info .badge').textContent.replace('Stock: ', '')}</small>
                                                    </span>
                                                </div>

                                            </div>
                                            <div class="last-order-detail d-flex justify-content-between align-items-center">
                                                <h6 class="txt-primary item-price">RS${formattedPrice}</h6>
                                                <a href="javascript:void(0)" class="trash-remove text-danger">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                            <div class="touchspin-wrapper">
                                                    <button class="decrement-touchspin btn-touchspin">
                                                        <i class="fa fa-minus text-gray"></i>
                                                    </button>
                                                    <input class="input-touchspin item-quantity" type="number" value="1" readonly>
                                                    <button class="increment-touchspin btn-touchspin">
                                                        <i class="fa fa-plus text-gray"></i>
                                                    </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        } else {
                            // Create an order card item
                            orderItem = `
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
                        }
                        // Append the order item to the order card
                        orderCardContainer.insertAdjacentHTML("beforeend", orderItem);

                        // Recalculate totals
                        calculateTotals();
                        // Hide "Your cart is empty" message
                        document.querySelector(".empty-card").style.display = "none";


                    }
                });

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

                        // Show empty cart message if no items are left
                        if (!document.querySelectorAll(".order-details-wrapper").length) {
                            document.querySelector(".empty-card").style.display = "block";
                        }


                    }

                    calculateTotals();
                });

                const brandLinks = document.querySelectorAll('.swiper-slide');

                brandLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();

                        // Get the brand ID from the clicked element
                        const brandId = this.querySelector('a').getAttribute('data-brand-id');

                        let endpoint = ``;


                        if (orderType == "New Order") {

                            endpoint = `/products-by-brand/${brandId}`;
                        } else if (orderType == "Repair") {
                            endpoint = `/repair-products-by-brand/${brandId}`;

                        }


                        // Send an AJAX request to fetch products by brand
                        fetch(endpoint)
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

                const brandSection = document.querySelector('.card-header.card-no-border').closest('.card');
                const oldBatteryBtn = document.querySelector('.btn-outline-secondary');
                const newBatteryBtn = document.querySelector('.btn-outline-primary');
                const repairBatteryBtn = document.querySelector('.btn-outline-success');
                const productContainer = document.querySelector('.scroll-product');

                // Function to fetch and render old batteries
                async function loadOldBatteries() {
                    try {
                        const response = await fetch('/api/old-batteries');
                        const oldBatteries = await response.json();

                        if (oldBatteries.length === 0) {
                            productContainer.innerHTML =
                                '<div class="col-12 text-center"><p>No old batteries available.</p></div>';
                            return;
                        }

                        const oldBatteriesHTML = oldBatteries.map(battery => `
                                <div class="col-xxl-3 col-sm-4">
                                    <div class="our-product-wrapper h-100 widget-hover"
                                        dataId="${battery.id}"
                                        data-name="Old Battery - ${battery.old_battery_type}"
                                        data-price="${battery.old_battery_value}">
                                        <div class="our-product-content">
                                            <div class="battery-status mb-2">
                                                <span class="badge ${battery.battery_status === 'Direct' ? 'bg-success' : 'bg-warning'}">
                                                    ${battery.battery_status}
                                                </span>
                                                <span class="badge ${getConditionBadgeClass(battery.old_battery_condition)}">
                                                    ${battery.old_battery_condition}
                                                </span>
                                            </div>
                                            <h6 class="f-14 f-w-500 pt-2 pb-1">${battery.old_battery_type}</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="txt-primary">RS ${formatPriceForOldBattery(battery.old_battery_value)}</h6>
                                                    <small class="text-muted">Added: ${formatDate(battery.created_at)}</small>
                                                </div>
                                                <div class="add-quantity btn border text-gray f-12 f-w-500">
                                                    <i class="fa fa-minus remove-minus count-decrease"></i>
                                                    <button class="btn add-btn btn-sm p-1">Add</button>
                                                    <i class="fa fa-plus count-increase"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `).join('');

                        productContainer.innerHTML = oldBatteriesHTML;
                    } catch (error) {
                        console.error('Error loading old batteries:', error);
                        productContainer.innerHTML =
                            '<div class="col-12 text-center"><p>Error loading old batteries.</p></div>';
                    }
                }

                // Helper function to get condition badge class
                function getConditionBadgeClass(condition) {
                    switch (condition) {
                        case 'Good':
                            return 'bg-success';
                        case 'Average':
                            return 'bg-warning';
                        case 'Poor':
                            return 'bg-danger';
                        default:
                            return 'bg-secondary';
                    }
                }

                // Helper function to get badge class based on status
                function getStatusBadgeClass(status) {
                    return status === 'Direct' ? 'badge-success' : 'badge-warning';
                }
                // Helper function to format date
                function formatDate(dateString) {
                    return new Date(dateString).toLocaleDateString();
                }

                // Helper function to format price
                function formatPriceForOldBattery(price) {
                    return new Intl.NumberFormat('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    }).format(price);
                }


                // Store the original products HTML
                const originalProductsHtml = productContainer.innerHTML;

                // Event listeners for battery type buttons
                oldBatteryBtn.addEventListener('click', function() {
                    const orderQuantitySection = document.querySelector('.order-quantity');
                    orderQuantitySection.innerHTML = '';
                    brandSection.style.display = 'none';
                    loadOldBatteries();
                    oldBatteryBtn.classList.add('active');
                    newBatteryBtn.classList.remove('active');
                    repairBatteryBtn.classList.remove('active');
                });

                // Function to load all batteries
                async function loadAllBatteries() {
                    try {
                        const response = await fetch('/admin/POS/batteries'); // You'll need to create this endpoint
                        const batteries = await response.json();

                        if (batteries.length === 0) {
                            productContainer.innerHTML =
                                '<div class="col-12 text-center"><p>No batteries available.</p></div>';
                            return;
                        }

                        const batteriesHTML = batteries.map(battery => `
                                <div class="col-xxl-3 col-sm-4">
                                    <div class="our-product-wrapper h-100 widget-hover"
                                        dataId="${battery.id}"
                                        data-name="${battery.model_name}"
                                        data-price="${battery.selling_price}"
                                        data-image="/storage/${battery.image}">
                                        <div class="our-product-img">
                                            <img src="/storage/${battery.image}" alt="${battery.model_name}">
                                        </div>
                                        <div class="our-product-content">
                                            <h6 class="f-14 f-w-500 pt-2 pb-1">${battery.model_name}</h6>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h6 class="txt-primary">RS ${new Intl.NumberFormat('en-US', {
                                                    minimumFractionDigits: 2,
                                                    maximumFractionDigits: 2
                                                }).format(battery.selling_price)}</h6>
                                                <div class="add-quantity btn border text-gray f-12 f-w-500">
                                                    <i class="fa fa-minus remove-minus count-decrease"></i>
                                                    <button class="btn add-btn btn-sm p-1">Add</button>
                                                    <i class="fa fa-plus count-increase"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `).join('');

                        productContainer.innerHTML = batteriesHTML;
                    } catch (error) {
                        console.error('Error loading batteries:', error);
                        productContainer.innerHTML =
                            '<div class="col-12 text-center"><p>Error loading batteries.</p></div>';
                    }
                }

                // Update the newBatteryBtn click handler
                newBatteryBtn.addEventListener('click', function() {
                    const orderQuantitySection = document.querySelector('.order-quantity');
                    orderQuantitySection.innerHTML = '';
                    brandSection.style.display = 'block';
                    loadAllBatteries();
                    newBatteryBtn.classList.add('active');
                    oldBatteryBtn.classList.remove('active');
                    repairBatteryBtn.classList.remove('active');
                });

                // Event listeners for battery type buttons
                repairBatteryBtn.addEventListener('click', function() {
                    const orderQuantitySection = document.querySelector('.order-quantity');
                    orderQuantitySection.innerHTML = '';
                    brandSection.style.display = 'block';
                    loadRepairBatteries();
                    repairBatteryBtn.classList.add('active');
                    newBatteryBtn.classList.remove('active');
                    oldBatteryBtn.classList.remove('active');
                });

                async function loadRepairBatteries() {
                    try {
                        const response = await fetch('/api/repair-batteries');
                        const repairBatteries = await response.json();

                        if (repairBatteries.length === 0) {
                            productContainer.innerHTML =
                                '<div class="col-12 text-center"><p>No repair batteries available.</p></div>';
                            return;
                        }

                        const repairBatteriesHTML = repairBatteries.map(battery => `
                                    <div class="col-xxl-3 col-sm-4">
                                        <div class="our-product-wrapper h-100 widget-hover"
                                            data-id="${battery.id}"
                                            data-name="Repair Battery"
                                            data-type="${battery.type}"
                                            data-price="${battery.selling_price}">
                                            <div class="our-product-content">
                                                <div class="battery-info mb-2">
                                                    <span class="badge ${battery.isForSelling ? 'bg-success' : 'bg-secondary'}">
                                                        ${battery.isForSelling ? 'For Sale' : 'Not for Sale'}
                                                    </span>
                                                    <span class="badge ${battery.isActive ? 'bg-primary' : 'bg-danger'}">
                                                        ${battery.isActive ? 'Active' : 'Inactive'}
                                                    </span>
                                                </div>
                                                <div class="battery-details">
                                                    <h6 class="f-14 f-w-500 pt-2">${battery.type}</h6>
                                                    <p class="text-muted mb-2">Model: ${battery.model_number}</p>
                                                </div>
                                                <div class="stock-info mb-2">
                                                    <span class="badge bg-info">
                                                        Stock: ${battery.stock_quantity || 0}
                                                    </span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h6 class="txt-primary">RS ${formatPrice2(battery.selling_price)}</h6>
                                                        <small class="text-muted">Added: ${formatDate2(battery.added_date)}</small>
                                                    </div>
                                                    <div class="add-quantity btn border text-gray f-12 f-w-500">
                                                        <i class="fa fa-minus remove-minus count-decrease"></i>
                                                        <button class="btn add-btn btn-sm p-1">Add</button>
                                                        <i class="fa fa-plus count-increase"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `).join('');

                        productContainer.innerHTML = repairBatteriesHTML;

                        // Add event listeners for quantity controls
                        setupQuantityControls();
                    } catch (error) {
                        console.error('Error loading repair batteries:', error);
                        productContainer.innerHTML =
                            '<div class="col-12 text-center"><p>Error loading repair batteries.</p></div>';
                    }
                }


                // Setup quantity control event listeners
                function setupQuantityControls() {
                    document.querySelectorAll('.count-decrease').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const quantityInput = this.parentElement.querySelector('.add-btn');
                            // Add your quantity decrease logic here
                        });
                    });

                    document.querySelectorAll('.count-increase').forEach(btn => {
                        btn.addEventListener('click', function() {
                            const quantityInput = this.parentElement.querySelector('.add-btn');
                            // Add your quantity increase logic here
                        });
                    });
                }

                // Helper function to format date
                function formatDate2(date) {
                    return new Date(date).toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'short',
                        day: 'numeric'
                    });
                }
                // Helper function to format price
                function formatPrice2(price) {
                    return price ? parseFloat(price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") : "0.00";
                }


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

            });



            // Helper function to format date
            function formatDate2(date) {
                return new Date(date).toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                });
            }
            // Helper function to format price
            function formatPrice2(price) {
                return price ? parseFloat(price).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") : "0.00";
            }
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
        // On document ready, update the DOM elements using our helper functions
        $(document).ready(function() {
            // Update all price elements
            $('.price').each(function() {
                var price = $(this).data('price');
                $(this).text(formatPriceForOldBattery(price));
            });

            // Update all date elements
            $('.date').each(function() {
                var dateString = $(this).data('date');
                $(this).text(formatDate(dateString));
            });

            // Update condition badge classes
            $('.condition-badge').each(function() {
                var condition = $(this).data('condition');
                $(this).removeClass().addClass('badge').addClass(getConditionBadgeClass(condition));
                // Optionally, update the text if needed:
                $(this).text(condition);
            });
        });


        $(document).ready(function() {
            $('#search-query').on('keyup', function() {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('admin.pos.search-products') }}",
                    type: "GET",
                    data: {
                        query: query
                    },
                    success: function(response) {



                        // Clear existing content in the scroll-product area
                        $('.scroll-product').empty();

                        if (orderType == "New Order") {
                            // Append new batteries
                            if (response.new_batteries) {
                                $('.scroll-product').append(response.new_batteries);
                            }
                        } else if (orderType == "Old Battery") {
                            // Append old batteries
                            if (response.old_batteries) {
                                $('.scroll-product').append(response.old_batteries);
                            }
                        } else if (orderType == "Repair") {
                            // Append repair batteries
                            if (response.repair_batteries) {
                                $('.scroll-product').append(response.repair_batteries);
                            }


                        }





                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>




@endsection

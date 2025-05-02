@extends('AdminDashboard.master')
@section('title', 'Ecommerce')

@section('css')

@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/animate.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Tax Management</h3>
@endsection

@section('breadcrumb-items')

    <li class="breadcrumb-item active">Tax</li>
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
                                <h2 class="content-title">Tax Details</h2>
                            </div>
                        </div>

                        <form id="taxForm" action="{{ route('tax.update', $tax->id) }}"
                            method="POST"enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class=" mb-4">
                                <label for="percentage my-2">Percentage</label>
                                <input type="percentage" name="percentage" class="form-control"
                                    value="{{ old('percentage', $tax->percentage ?? '') }}" placeholder="Type here"
                                    required>

                            </div>



                            <div class="mb-4">
                                <button type="submit" form="taxForm" class="btn btn-success col-md-3">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

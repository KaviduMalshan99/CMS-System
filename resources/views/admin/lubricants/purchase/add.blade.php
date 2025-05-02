@extends('AdminDashboard.master')
@section('title', 'Add Lubricant Purchase')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h5>Add Lubricant Purchase</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('lubricant_purchases.store') }}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="supplier_id" class="py-3">Supplier</label>
                                <select name="supplier_id" class="form-control" required>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Choices.js CSS -->
<link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet">

<style>
    /* Set the height and enable scrolling */
    .choices__list--dropdown, .choices__list[aria-expanded] {
        max-height: 250px !important; /* Set maximum height */
        overflow-y: auto !important;  /* Enable vertical scrolling */
    }
</style>

<div class="col-sm-6">
    <div class="form-group my-2">
        <label for="lubricant_id" class="py-3">Lubricant</label>
        <select id="lubricant_id" class="form-control" multiple required>
            @foreach ($lubricants as $lubricant)
                <option value="{{ $lubricant->id }}">{{ $lubricant->name }}</option>
            @endforeach
        </select>
        <input type="text" id="selected_lubricants" name="lubricant_id" value="" readonly class="form-control mt-2">

        <!-- Fixed input field -->
       
    </div>
</div>

<script>
    document.getElementById("lubricant_id").addEventListener("change", function() {
        let selectedOptions = Array.from(this.selectedOptions).map(option => option.value);
        document.getElementById("selected_lubricants").value = selectedOptions.join(", ");
    });
</script>

<!-- Choices.js JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Choices.js with scrolling enabled
        new Choices('#lubricant_id', {
            removeItemButton: true,  // Adds a remove button to each selected item
            searchEnabled: true,     // Enables search functionality
            placeholderValue: 'Select Lubricants', // Placeholder text
            maxItemCount: 5,         // Limit maximum selections to 5 (optional)
            duplicateItems: false,   // Prevents selecting the same item multiple times
            classNames: {
                listDropdown: 'custom-dropdown' // Custom class for styling
            }
        });
    });
</script>

                       
                    </div>



                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="unit_type" class="py-3"> Type</label>
                                <select name="unit_type" class="form-control" required>
                                    <option value="Loose">Loose </option>
                                    <option value="Item">Item </option>
                                  
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">


                            {{-- <div class="form-group my-2">
                                <label for="unit_type" class="py-3">Unit Type</label>
                                <select name="unit_type" class="form-control" required>
                                    <option value="Drum">Drum</option>
                                    <option value="Bottle">Bottle</option>
                                    <option value="Liter">Liter</option>
                                </select>
                            </div> --}}

                            <div class="form-group my-2">
                                <label for="total_cost"  class="py-3"> quantity</label>
                                <input type="text" name="loose" class="form-control" >
                            </div>


                        </div>
                    </div>


                    <div class="row">

                        <div class="col-sm-6">
                            {{-- <div class="form-group my-2">
                            <label for="total_cost"  class="py-3">Total Cost</label>
                            <input type="text" name="total_cost" class="form-control" required>
                        </div> --}}

                            <div class="form-group my-2">
                                <label for="quantity_purchased" class="py-3"> Purchased Price</label>
                                <input type="text" name="purchase_price" class="form-control"
                                    placeholder="Enter One quantity purchased price" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="quantity_purchased" class="py-3">Quantity Purchased</label>
                                <input type="text" name="quantity_purchased" placeholder="Enter quantity "
                                    class="form-control" required>
                            </div>
                        </div>

                    </div>



                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="quantity_purchased" class="py-3"> sale Price</label>
                                <input type="text" name="sale_price" class="form-control" placeholder=" Enter sale price"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="total_cost" class="py-3">Total Cost</label>
                                <input type="text" name="total_cost" class="form-control" placeholder=" Enter Total Cost"
                                    required>
                            </div>
                        </div>
                    </div>



                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="payment_status" class="py-3">Payment Status</label>
                                <select name="payment_status" class="form-control" required>
                                    <option value="full payment">Full Payment</option>
                                    <option value="half payment">Half Payment</option>
                                    <option value="online payment">Online Payment</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="status" class="py-3">Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Pending">Pending </option>
                                    <option value="Completed">Completed </option>
                                    <option value="Processing">Processing </option>
                                    <option value="Cancelled">Cancelled </option>
                                    <option value="On Hold">On Hold </option>
                                </select>
                            </div>

                        </div>
                    </div>




                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection





                            <!-- Supplier -->
                            <div class="mb-4">
                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-select" required>
                                    <option value="" disabled selected>Select Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Lubricant -->
                            <div class="mb-4">
                                <label for="lubricant_id" class="form-label">Lubricant</label>
                                <select name="lubricant_id" id="lubricant_id" class="form-select" required>
                                    <option value="" disabled selected>Select Lubricant</option>
                                    @foreach ($lubricants as $lubricant)
                                        <option value="{{ $lubricant->id }}" data-purchase-price="{{ $lubricant->purchase_price }}">
                                            {{ $lubricant->type }} | {{ $lubricant->brand->brand_name }} | RS: {{ $lubricant->purchase_price }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

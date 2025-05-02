@extends('AdminDashboard.master')
@section('title', 'Add Lubricant')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="my-3 pb-3">Add New Lubricant</h3>
                <form action="{{ route('lubricants.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2 ">
                        <label for="name" class="pb-2">Lubricant Name * </label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Lubricant Name" required>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="brand_id" class="pb-2">Brand *</label>
                                <select name="brand_id" id="brand_id" class="form-control" required>
                                    <option value="" disabled {{ old('brand_id') == '' ? 'selected' : '' }}>Select a Brand</option>
                                    @foreach ($brands as $brand)
                                        @if($brand->type == 'lubricant') <!-- Assuming 'category' is the column that stores brand category -->
                                            <option value="{{ $brand->brand_id }}"
                                                {{ old('brand_id') == $brand->brand_id ? 'selected' : '' }}>
                                                {{ $brand->brand_id }} - {{ $brand->brand_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                
                                @error('brand_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                        {{-- <div class="col-sm-6"> <div class="form-group my-2">
                <label for="purchase_price" class="pb-2">Purchase Price</label>
                <input type="number" class="form-control" name="purchase_price" required>
            </div></div> --}}

                        <div class="col-sm-6">

                            {{-- <div class="form-group my-2">
                <label for="type" class="pb-2">Type</label>
                <input type="text" class="form-control" name="type" required>
            </div> </div> --}}

                            {{-- <div class="form-group ">
                                <label for="unit_type" class="py-2">Unit Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Select type</option>
                                    <option value="Drum">Drum</option>
                                    <option value="Bottle">Bottle</option>
                                    <option value="ML-Liter">ML-Liter</option>
                                </select>
                            </div> --}}


                             <div class="form-group ">
                                <label for="unit_type" class="py-2"> Item Type *</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Select type</option>
                                    <option value="Loose">Loose </option>
                                    <option value="Item">Item </option>
                                </select>
                            </div>


                       

                        </div>

                    </div>

                    <div class="row">

                      

                        <script>
                            // document.getElementById('type').addEventListener('change', function () {
                            //     let looseInput = document.getElementById('looseInput');
                            //     let itemInput = document.getElementById('itemInput');
                        
                            //     if (this.value === 'Loose') {
                            //         looseInput.style.display = 'block';
                            //         itemInput.style.display = 'none';
                            //     } else if (this.value === 'Item') {
                            //         looseInput.style.display = 'none';
                            //         itemInput.style.display = 'block';
                            //     } else {
                            //         looseInput.style.display = 'none';
                            //         itemInput.style.display = 'none';
                            //     }
                            // });
                        </script>

                        <div class="col-sm-12">
                            <div class="form-group my-2">
                              
                                <input type="hidden" class="form-control" value="0" name="total_count"
                                    placeholder="Enter total quantity " required>
                            </div>
                        </div>

                    </div>



                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="purchase_price" class="pb-2">Purchase Price *</label>
                                <input type="number" class="form-control" placeholder="Enter Purchase Price"
                                    name="purchase_price" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group my-2">
                                <label for="sale_price" class="pb-2">Sale Price *</label>
                                <input type="number" class="form-control" placeholder="Enter  Sale Price "
                                    name="sale_price" required>
                            </div>
                        </div>

                        {{-- <div class="col-sm-6">
                <div class="form-group my-3">
                    <label for="sale_price" class="pb-2">Sale Price</label>
                    <input type="number" class="form-control" name="sale_price" required>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group my-3">
                    <label for="stock_quantity" class="pb-2">Stock Quantity</label>
                    <input type="number" class="form-control" name="stock_quantity" required>
                </div>
            </div> --}}

                    </div>


                    {{-- <div class="row">
            <div class="col-sm-6"><div class="form-group my-3">
                <label for="type" class="pb-2">Type</label>
                <input type="text" class="form-control" name="type" required>
            </div> </div> --}}
                    {{-- <div class="col-sm-6"> <div class="form-group my-3">
                <label for="unit" class="pb-2">Unit</label>
                <input type="text" class="form-control" name="unit" required>
            </div> </div> --}}
            </div>


            <div class="row">
                <div class="col-sm-12 ms-4">
                    <div class="form-group ">
                        <label for="image" class="pb-2">Lubricant Image </label>
                        <input type="file" class="form-control" name="image" required>
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Save</button>
                </div>
            </div>

            </form>
        </div>
    </div>
    </div>
@endsection

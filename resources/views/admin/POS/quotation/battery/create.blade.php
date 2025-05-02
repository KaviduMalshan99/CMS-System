@extends('AdminDashboard.master')
@section('title', 'Add Quotations')

<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="my-3 pb-3">Add New Quotations</h3>

                <form class="row g-3 needs-validation" action="{{ route('battery.quotations.store') }}" method="POST" novalidate>
                    @csrf


                    <input type="hidden" name="type" value="battery" id="">

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label" for="customer_nic">Select Customer <span class="text-danger">*</span></label>
                            <select class="form-control" id="customer_nic" name="customer_nic" required>
                                <option value="">Select Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->phone_number }}">
                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                    </option>
                                    
                                @endforeach
                            </select>
                            @error('customer_nic')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>






                        <div class="col-md-6">
                            <label class="form-label" for="quotation_items">Select Items <span class="text-danger">*</span></label>
                            <select class="form-control" id="quotation_items" name="quotation_items[]" required>
                                @foreach($batteries as $battery)
                                    <option value="{{ $battery->id }}"
                                            data-model="{{ $battery->model_name }}"
                                            data-brand-id="{{ $battery->brand_id }}"
                                            data-capacity="{{ $battery->capacity }}"
                                            data-voltage="{{ $battery->voltage }}"
                                            data-type="{{ $battery->type }}"
                                            data-sale-price="{{ $battery->selling_price }}">
                                        {{ $battery->model_name }} - {{ $battery->type }} ({{ $battery->capacity }}Ah, {{ $battery->voltage }}V)
                                    </option>
                                @endforeach
                            </select>
                            @error('quotation_items')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        
                    </div>

                    <!-- Add Button -->
                    <div class="mb-4">
                        <br>
                        <button type="button" id="addProduct" class="btn btn-primary col-md-3">Add</button>
                    </div>

                    <!-- Hidden Input to Store Items JSON -->
                    <input type="hidden" name="quotation_items" id="items" readonly>

                    <!-- Dynamic Table -->
                    <table class="table table-bordered mt-4" id="productTable">
                        <thead>
                            <tr>
                                <th>Item ID</th>
                                
                                <th>Model No</th>
                                <th>Type</th>
                                <th>Price</th>
                               
                                <th>Quantity</th>
                                <th>Discount (LKR)</th>
                                <th>Subtotal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <hr class="mt-4 form-horizontal">

                    <!-- New Fields -->
                    <div class="row my-3">
                        <div class="col-md-6">
                            <label class="form-label py-3" for="total_price">Total Price</label>
                            <input class="form-control" id="total_price" name="total_price" type="number" step="0.01" placeholder="Total Price" required readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label py-3" for="discount">Discount (%)</label>
                            <input class="form-control" id="discount" name="discount" type="number" step="0.01" placeholder="Enter Discount" value="0" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label py-3" for="due_amount">Due Amount</label>
                            <input class="form-control" id="due_amount" name="due_amount" type="number" step="0.01" placeholder="Due Amount" required readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label py-3" for="quotation_date">Quotation Date <span class="text-danger">*</span></label>
                            <input class="form-control" id="quotation_date" name="quotation_date" type="date" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label py-3" for="quotation_validity">Validity Period (Days) <span class="text-danger">*</span></label>
                            <input class="form-control" id="quotation_validity" name="quotation_validity" type="number" required>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label py-3" for="quotation_notes">Additional Notes</label>
                            <textarea class="form-control" id="quotation_notes" name="quotation_notes" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="col-md-12 d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit">Generate Quotation</button>
                    </div>

                    <!-- JavaScript -->
                  <!-- JavaScript -->
                  <script>
                    $(document).ready(function() {
                        $('#customer_nic').select2();
                        $('#quotation_items').select2();
                    });

                    document.getElementById('addProduct').addEventListener('click', function() {
                        const selectElement = document.getElementById('quotation_items');
                        const productTable = document.getElementById('productTable').querySelector('tbody');

                        Array.from(selectElement.selectedOptions).forEach(option => {
                            const itemId = option.value;
                            const itemName = option.getAttribute('data-name');
                            const modelNo = option.getAttribute('data-model');
                            const salePrice = parseFloat(option.getAttribute('data-sale-price'));
                            const type = option.getAttribute('data-type'); // Retrieve type from data attribute

                            // Check if item is already in the table
                            if (document.querySelector(`tr[data-item-id="${itemId}"]`)) {
                                alert('Item already added!');
                                return;
                            }

                            // Add row to the table with quantity and discount inputs
                            const newRow = `
                                 <tr data-item-id="${itemId}" data-model-no="${modelNo}" data-sale-price="${salePrice}" data-type="${type}">
                                    <td>${itemId}</td>
                                    
                                    <td>${modelNo}</td>
                                    <td>${type}</td>
                                    
                                    <td>${salePrice.toFixed(2)}</td>
                                    <td><input type="number" class="form-control qty-input" value="1" min="1" style="width: 80px;"></td>
                                    <td><input type="number" class="form-control discount-input" value="0" min="0" step="0.01" style="width: 80px;"></td>
                                    <td class="subtotal">${salePrice.toFixed(2)}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-row">Remove</button>
                                    </td>
                                </tr>
                            `;
                            productTable.insertAdjacentHTML('beforeend', newRow);
                        });

                        updateTable();
                    });

                    document.getElementById('productTable').addEventListener('click', function(event) {
                        if (event.target.classList.contains('remove-row')) {
                            event.target.closest('tr').remove();
                            updateTable();
                        }
                    });

                    document.getElementById('productTable').addEventListener('input', function(event) {
                        if (event.target.classList.contains('qty-input') || event.target.classList.contains('discount-input')) {
                            const row = event.target.closest('tr');
                            const salePrice = parseFloat(row.getAttribute('data-sale-price'));
                            const quantity = parseInt(row.querySelector('.qty-input').value) || 1;
                            const discountLkr = parseFloat(row.querySelector('.discount-input').value) || 0;
                            const subtotal = (salePrice * quantity) - discountLkr;
                            row.querySelector('.subtotal').textContent = subtotal.toFixed(2);
                            updateTable();
                        }
                    });

                    document.getElementById('discount').addEventListener('input', function() {
                        updateTable();
                    });

                    function updateTable() {
                        const productTable = document.getElementById('productTable').querySelector('tbody');
                        const rows = productTable.querySelectorAll('tr');
                        let totalPrice = 0;

                        const items = Array.from(rows).map(row => {
                            const salePrice = parseFloat(row.getAttribute('data-sale-price'));
                            const quantity = parseInt(row.querySelector('.qty-input').value) || 1;
                            const discountLkr = parseFloat(row.querySelector('.discount-input').value) || 0;
                            const type = row.getAttribute('data-type'); // Retrieve type from row
                            const subtotal = (salePrice * quantity) - discountLkr;
                            row.querySelector('.subtotal').textContent = subtotal.toFixed(2);
                            totalPrice += subtotal;

                            return {
                                id: row.getAttribute('data-item-id'),
                                name: row.cells[1].textContent,
                                model_no: row.getAttribute('data-model-no'),
                                type: type, // Include type in JSON
                                sale_price: salePrice,
                                quantity: quantity,
                                discount_lkr: discountLkr,
                                subtotal: subtotal
                            };
                        });

                        // Update total price and due amount
                        const discountPercent = parseFloat(document.getElementById('discount').value) || 0;
                        const totalPriceElement = document.getElementById('total_price');
                        const dueAmountElement = document.getElementById('due_amount');

                        totalPriceElement.value = totalPrice.toFixed(2);
                        const discountAmount = totalPrice * (discountPercent / 100);
                        const dueAmount = totalPrice - discountAmount;

                        dueAmountElement.value = dueAmount.toFixed(2);

                        // Update hidden input with items JSON
                        document.getElementById('items').value = JSON.stringify(items);
                    }
                </script>
                </form>
            </div>
        </div>
    </div>
@endsection

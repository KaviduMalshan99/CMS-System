<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchase Invoice</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
                margin: 10;
                padding: 0;
            }

            .bill-container {
                width: 210mm;
                height: 297mm;
                padding: 25mm;
                box-sizing: border-box;
                margin: auto;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #000;
                padding-bottom: 20px;
            }

            .header .logo {
                width: 100px;
            }

            .header .company-info {
                text-align: right;
            }

            .header .company-info h1 {
                margin: 0;
                font-size: 18px;
            }

            .header .company-info p {
                margin: 1px 0;
            }

            .section {
                margin-bottom: 10px;
            }

            .section h2 {
                font-size: 14px;
                text-decoration: underline;
                margin-bottom: 10px;
            }

            .section table {
                width: 100%;
                border-collapse: collapse;
            }

            .section table,
            .section table th,
            .section table td {
                border: 1px solid #000;
            }

            .section table th,
            .section table td {
                padding: 7px;
                text-align: left;
            }

            .section .label {
                font-weight: bold;
            }

            .footer {
                text-align: center;
                margin-top: 30px;
            }

            .footer .prepared-by {
                margin-top: 10px;
                font-weight: bold;
                text-align: left;
            }

            @media print {
                .bill-container {
                    border: none;
                    padding: 25px;
                    margin: 0;
                    width: 100%;
                    height: auto;
                }

                .header {
                    border-bottom: 2px solid #000;
                }
            }
        </style>
    </head>

    <body>

        <div class="bill-container">
            <!-- Header Section -->
            <div class="header">
                <div class="logo">
                    <img src="{{ Storage::url($companyDetails->company_logo ?? '') }}" alt="Lubricant Purchase Logo"
                        style="width: 100px; height: auto;">
                </div>
                <div class="company-info">
                    <h1>{{ $companyDetails->company_name ?? '' }}</h1>
                    <p>{{ $companyDetails->address ?? '' }}</p>
                    <p>{{ $companyDetails->email ?? '' }}</p>
                    <p>{{ $companyDetails->contact ?? '' }}</p>

                </div>
            </div>

            <!-- Date and Bill Number -->
            <div class="section" style="display: flex; justify-content: space-between; margin-bottom: 20px;">
                <p><span class="label">Date:</span> {{ $currentDateTime }}</p>
                <p><span class="label">Purchase Order No:</span> {{ $purchase->purchase_id ?? 'N/A' }}</p>
            </div>

            <!-- Section 1: Customer Details -->
            <div class="section">
                <h2>Purchase Details</h2>
                <table>
                    <tr>
                        <td class="label">Name:</td>
                        <td>{{ $purchase->supplier->name }}</td>
                        <td class="label">Contact:</td>
                        <td>{{ $purchase->supplier->phone_number }}</td>
                    </tr>
                </table>
            </div>

            <!-- Section 2: Order Details -->
            <div class="section">
                <h3>Purchased Items</h3>
                @php
                    // Convert lubricant IDs and quantities into arrays, trimming spaces
                    $lubricantIds = array_map('trim', explode(',', $purchase->lubricant_ids));
                    $quantities = array_map('trim', explode(',', $purchase->quantity));

                    // Fetch lubricants with both 'name' and 'model_no'
                    $lubricants = \App\Models\Lubricant::whereIn('id', $lubricantIds)
                        ->get(['id', 'name', 'model_no'])
                        ->keyBy('id'); // Index by ID for easy access
                @endphp

                <table>
                    <tr>
                        <th>Item Name</th>
                        <th>Model No</th>
                        <th>Quantity</th>
                    </tr>

                    @foreach ($lubricantIds as $index => $lubricantId)
                        <tr>
                            <td>{{ $lubricants[$lubricantId]->name ?? 'Unknown' }}</td> {{-- Lubricant Name --}}
                            <td>{{ $lubricants[$lubricantId]->model_no ?? 'N/A' }}</td> {{-- Model No --}}
                            <td>{{ $quantities[$index] ?? 0 }}</td> {{-- Corresponding Quantity --}}
                        </tr>
                    @endforeach
                </table>

            </div>


            <!-- Section 3: Charges Summary -->
            <div class="section">

                <h3>Charges Summary</h3>
                <table>
                    <tr>
                        <th>Description</th>
                        <th>Amount (LKR)</th>
                    </tr>
                    <tr>
                        <td><strong>Sub Total</strong></td>
                        <td>{{ number_format($purchase->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Total Cost</strong></td>
                        <td>{{ number_format($purchase->due_amount, 2) }}</td>
                    </tr>
                </table>
            </div>

            <!-- Section 4: Payment Details -->
            <div class="section">
                <h2>Payment Details</h2>
                <h3>Payment Details</h3>
                <table>
                    <tr>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Paid Amount (LKR)</th>
                        <th>Due Amount (LKR)</th>
                    </tr>
                    <tr>
                        <td>{{ $purchase->payment_type ?? 'N/A' }}</td>
                        <td>{{ $purchase->payment_status ?? 'Pending' }}</td>
                        <td>{{ number_format($purchase->paid_amount ?? 0, 2) }}</td>
                        <td>{{ number_format($purchase->due_amount, 2) }}</td>
                    </tr>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="footer">

                <h3>Prepared By:</h3>
                <p><strong>{{ Auth::user()->name ?? 'N/A' }}</strong></p>
                <p><em>Authorized Representative</em></p>

                <p>This invoice serves as an official document for your purchase. Please retain it for future reference.
                    Thank you for choosing <strong>Lubricant Purchase </strong>!</p>


            </div>
        </div>

        <script>
            window.print(); // Automatically trigger print dialog

            // After printing, redirect to the bookings list
            window.onafterprint = function() {
                window.location.href =
                    "{{ request()->query('ref') === 'view' ? route('lubricant_purchases.show', $purchase->id) : route('lubricant_purchases.index') }}";
            };
        </script>

    </body>

</html>

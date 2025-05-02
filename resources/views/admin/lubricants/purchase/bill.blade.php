<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Premium Battery Invoice</title>
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
                    <img src="{{ $companyDetails->company_logo ? asset('storage/' . $companyDetails->company_logo) : asset('assets/images/banner/3.jpg') }}"
                        alt="Premium Battery Logo" style="width: 100px; height: auto;">
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
                <p><span class="label"><strong>Purchase ID:</strong> </span> {{ $purchase->purchase_id ?? 'N/A' }}</p>
            </div>

            <!-- Section 1: Customer Details -->
            <div class="section">
                <h2>Customer Details</h2>
                <table>
                    <tr>
                        <td class="label">Name:</td>
                        <td>{{ optional($purchase->supplier)->name ?? 'N/A' }} </td>
                        <td class="label">Contact:</td>
                        <td>{{ optional($purchase->supplier)->phone_number ?? 'N/A' }}</td>



                    </tr>
                </table>
            </div>

            <!-- Section 2: Purchese Details -->
            {{-- <div class="section">
                <h2>Purchese Details</h2>
                <table>
                    <tr>
                        <td class="label">Order Type:</td>
                        <td colspan="3">{{ $batteryOrder->order_type }}</td>
                    </tr>
                    <tr>
                        <td class="label">Order Date:</td>
                        <td>{{ $batteryOrder->order_date }}</td>
                    </tr>

                </table>
            </div> --}}

            <!-- Section 3: item Summary -->
            <div class="section">
                <h2>Purchese Items</h2>
                <table>
                    <tr>
                        <th class="label">Purchese Details</th>
                        <th class="label">Quantity</th>
                        <th style="text-align: right;">Price (LKR)</th>
                    </tr>
                    @if (is_array($items))
                        @foreach ($items as $item)
                            <tr>
                                <td class="label">
                                <td>
                                    @php
                                        $lubricantNames = \App\Models\Lubricant::whereIn(
                                            'id',
                                            explode(',', $purchase->lubricant_ids),
                                        )
                                            ->pluck('name')
                                            ->toArray();
                                    @endphp
                                    {{ implode(', ', $lubricantNames) }}
                                </td>



                                </td>
                                <td class="label">{{ $item['quantity'] }}</td>
                                <td style="text-align: right;">{{ number_format($item['price'], 2) }} x
                                    {{ $item['quantity'] }}</td>
                            </tr>
                        @endforeach
                    @else
                        <td>No items found</td>
                    @endif

                </table>
            </div>

            <!-- Section 3: Charges Summary -->
            <div class="section">
                <h2>Charges Summary</h2>
                <table>


                    <tr>
                        <td class="label">Total Cost (LKR):</td>
                        <td style="text-align: right;">{{ $purchase->due_amount }}</td>
                    </tr>

                    <tr>
                        <td class="label">Sub Total (LKR):</td>
                        <td style="text-align: right;">{{ $purchase->subtotal }}</td>
                    </tr>

                </table>
            </div>

            <!-- Section 4: Payment Details -->
            <div class="section">
                <h2>Payment Details</h2>
                <table>
                    <tr>
                        <td class="label">Payment Type:</td>
                        <td style="text-align: right;">{{ $purchase }}</td>
                    </tr>
                    <tr>
                        <td class="label">Payment Status:</td>
                        <td style="text-align: right;">{{ $purchase->payment_status }}</td>
                    </tr>
                    <tr>
                        <td class="label">Paid Amount (LKR):</td>
                        <td style="text-align: right;">{{ $purchase->paid_amount ?? '0' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Due Amount (LKR):</td>
                        <td style="text-align: right;">{{ $purchase->due_amount ?? '0' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="footer">
                <p class="prepared-by">Prepared By: {{ $purchase->user->name }}</p>
                <p>Thank you for choosing Premium Battery. We hope you had a pleasant stay!</p>

            </div>
        </div>

        <script>
            window.print(); // Automatically trigger print dialog

            // After printing, redirect to the bookings list
            window.onafterprint = function() {
                window.location.href =
                    "{{ request()->query('ref') === 'view' ? route('POS.show', $batteryOrder->id) : route('lubricant_purchases.bill') }}";
            };
        </script>

    </body>

</html>

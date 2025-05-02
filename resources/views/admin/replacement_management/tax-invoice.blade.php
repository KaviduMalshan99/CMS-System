<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Premium Battery Tax Invoice</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 9px;
                margin: 10%;
                padding: 0;
            }

            .bill-container {
                width: 148mm;
                /* A5 width */
                height: 210mm;
                /* A5 height */
                padding: 10mm;
                box-sizing: border-box;
                margin: auto;
                page-break-after: always;
            }

            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #000;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }

            .header .logo {
                width: 60px;
            }

            .header .company-info {
                text-align: right;
            }

            .header .company-info h1 {
                margin: 0;
                font-size: 14px;
            }

            .header .company-info p {
                margin: 0;
                line-height: 1.2;
            }

            .section {
                margin-bottom: 8px;
            }

            .section h2 {
                font-size: 10px;
                text-decoration: underline;
                margin: 5px 0;
            }

            .section table {
                width: 100%;
                border-collapse: collapse;
                font-size: 8px;
            }

            .section table,
            .section table th,
            .section table td {
                border: 1px solid #000;
            }

            .section table th,
            .section table td {
                padding: 3px;
                text-align: left;
            }

            .section .label {
                font-weight: bold;
            }

            .top-info {
                display: flex;
                justify-content: space-between;
                margin-bottom: 8px;
                font-size: 9px;
            }

            .footer {
                text-align: center;
                margin-top: 10px;
                font-size: 8px;
            }

            .footer .prepared-by {
                margin-top: 5px;
                font-weight: bold;
                text-align: left;
                font-size: 9px;
            }

            @media print {
                body {
                    width: 148mm;
                    height: 210mm;
                }

                .bill-container {
                    border: none;
                    padding: 10mm;
                    margin: 0;
                    width: 128mm;
                    /* A5 width minus padding */
                    height: 190mm;
                    /* A5 height minus padding */
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
                <p><span class="label">Tax Invoice ID:</span> TIN{{ $replacement->tax_invoice_id }}</p>
            </div>

            <!-- Section 1: Customer Details -->
            <div class="section">
                <h2>Company Details</h2>
                <table>
                    <tr>
                        <td class="label">Company Tax Name:</td>
                        <td>{{ $companyDetails->company_tax_name }} </td>
                        <td class="label">Tax Number:</td>
                        <td>{{ $companyDetails->company_tax_number }}</td>
                    </tr>
                </table>
            </div>

            <!-- Section 1: Customer Details -->
            <div class="section">
                <h2>Customer Details</h2>
                <table>
                    <tr>
                        <td class="label">Name:</td>
                        <td>{{ $replacement->order->customer->first_name }}
                            {{ $replacement->order->customer->last_name }}
                        </td>
                        <td class="label">Contact:</td>
                        <td>{{ $replacement->order->customer->phone_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tax Holder Name:</td>
                        <td>{{ $replacement->order->customer->tax_holder_name }} </td>
                        <td class="label">Tax Number:</td>
                        <td>{{ $replacement->order->customer->tax_number }}</td>
                    </tr>
                </table>
            </div>

            <!-- Section 2: Order Details -->
            <div class="section">
                <h2>Replacement Details</h2>
                <table>
                    <tr>
                        <td class="label">Replacement Reason:</td>
                        <td colspan="3">{{ $replacement->replacement_reason }}</td>
                    </tr>
                    <tr>
                        <td class="label">Replacement Date:</td>
                        <td>{{ $replacement->replacement_date }}</td>
                    </tr>

                </table>
            </div>

            <!-- Section 3: item Summary -->
            <div class="section">
                <h2>Bought Battery</h2>
                <table>
                    <tr>
                        <th class="label">Battery Details</th>
                        <th class="label">Quantity</th>
                        <th style="text-align: right;">Price (LKR)</th>
                    </tr>
                    <tr>
                        <td class="label">
                            New Battery: {{ $replacement->boughtOldBattery->model_name }},

                        </td>
                        <td class="label">{{ $replacement->bought_old_battery_quantity }}</td>
                        <td style="text-align: right;">{{ number_format($replacement->bought_old_battery_price, 2) }} x
                            {{ $replacement->bought_old_battery_quantity }}</td>
                    </tr>

                </table>
            </div>

            <!-- Section 3: item Summary -->
            <div class="section">
                <h2>Replace Battery</h2>
                <table>
                    <tr>
                        <th class="label">Battery Details</th>
                        <th class="label">Quantity</th>
                        <th style="text-align: right;">Price (LKR)</th>
                    </tr>
                    <tr>
                        <td class="label">
                            New Battery: {{ $replacement->newBattery->model_name }},

                        </td>
                        <td class="label">{{ $replacement->new_battery_quantity }}</td>
                        <td style="text-align: right;">{{ number_format($replacement->new_battery_price, 2) }} x
                            {{ $replacement->new_battery_quantity }}</td>
                    </tr>

                </table>
            </div>

            <!-- Section 3: Charges Summary -->
            <div class="section">
                <h2>Charges Summary</h2>
                <table>
                    @if (!empty($replacement->percentage))
                        <tr>
                            <td class="label">Tax (%):</td>
                            <td style="text-align: right;">{{ $replacement->percentage }} %</td>
                        </tr>
                    @endif
                    @if (!empty($replacement->tax_invoice_id))
                        <tr>
                            <td class="label">Tax Price (LKR):</td>
                            <td style="text-align: right;">{{ $replacement->taxInvoice->tax_paid }}</td>
                        </tr>
                    @endif
                    @if ($replacement->battery_discount != 0.0)
                        <tr>
                            <td class="label">Battery Discount (LKR):</td>
                            <td style="text-align: right;">{{ $replacement->battery_discount }}</td>
                        </tr>
                    @endif
                    @if ($replacement->old_battery_discount_value != 0.0)
                        <tr>
                            <td class="label">Old Battery Discount (LKR):</td>
                            <td style="text-align: right;">{{ $replacement->old_battery_discount_value }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td class="label">Price Adjustment (LKR):</td>
                        <td style="text-align: right;">{{ $replacement->price_adjustment }}</td>
                    </tr>

                    <tr>
                        <td class="label">Total Cost (LKR):</td>
                        <td style="text-align: right;">{{ $replacement->total_price }}</td>
                    </tr>

                    <tr>
                        <td class="label">Sub Total (LKR):</td>
                        <td style="text-align: right;">{{ $replacement->subtotal }}</td>
                    </tr>

                </table>
            </div>

            <!-- Section 4: Payment Details -->
            <div class="section">
                <h2>Payment Details</h2>
                <table>
                    <tr>
                        <td class="label">Payment Type:</td>
                        <td style="text-align: right;">{{ $payment_type }}</td>
                    </tr>
                    <tr>
                        <td class="label">Payment Date:</td>
                        <td style="text-align: right;">{{ $replacement->taxInvoice->bill_issued_date }}</td>
                    </tr>
                    <tr>
                        <td class="label">Payment Status:</td>
                        <td style="text-align: right;">{{ $replacement->payment_status }}</td>
                    </tr>
                    <tr>
                        <td class="label">Paid Amount (LKR):</td>
                        <td style="text-align: right;">{{ $replacement->paid_amount ?? '0' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Due Amount (LKR):</td>
                        <td style="text-align: right;">{{ $replacement->due_amount ?? '0' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="footer">
                <p class="prepared-by">Prepared By: {{ $replacement->user->name }}</p>
                <p>Thank you for choosing Premium Battery. We hope you had a pleasant stay!</p>

            </div>
        </div>

        <script>
            window.print(); // Automatically trigger print dialog

            // After printing, redirect to the bookings list
            window.onafterprint = function() {
                window.location.href =
                    "{{ request()->query('ref') === 'view' ? route('replacements.show', $replacement->id) : route('replacements.index') }}";
            };
        </script>

    </body>

</html>

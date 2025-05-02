<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Premiun Battery Tax Invoice</title>
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
                <p><span class="label">Tax Invoice ID:</span> TIN{{ $rental->tax_invoice_id }}</p>
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
                        <td>{{ $rental->customer->first_name }} {{ $rental->customer->last_name }}</td>
                        <td class="label">Contact:</td>
                        <td>{{ $rental->customer->phone_number }}</td>
                    </tr>
                    <tr>
                        <td class="label">Tax Holder Name:</td>
                        <td>{{ $rental->customer->tax_holder_name }} </td>
                        <td class="label">Tax Number:</td>
                        <td>{{ $rental->customer->tax_number }}</td>
                    </tr>
                </table>
            </div>

            <!-- Section 2: rental Details -->
            <div class="section">
                <h2>Rental Details</h2>
                <table>
                    <tr>
                        <td class="label">Battery Type :</td>
                        <td>{{ $rental->oldBattery->old_battery_type }}</td>
                    </tr>
                    <td class="label">Condition:</td>
                    <td>{{ $rental->oldBattery->old_battery_condition }}</td>
                    </tr>
                    <td class="label">Battery Value:</td>
                    <td>{{ $rental->oldBattery->old_battery_value }}</td>
                    </tr>
                    </tr>
                    <td class="label">Battery Quantity:</td>
                    <td>{{ $rental->old_battery_quantity }}</td>
                    </tr>
                    <tr>
                        <td class="label">Rental Start Date:</td>
                        <td>{{ $rental->rental_start_date }}</td>
                    </tr>
                    <td class="label">Rental End Date:</td>
                    <td>{{ $rental->rental_end_date }}</td>
                    </tr>
                    @if (!empty($rental->actual_return_date))
                        <tr>
                            <td class="label">Actual Return Date:</td>
                            <td>{{ $rental->actual_return_date }}</td>
                        </tr>
                    @endif
                </table>
            </div>

            <!-- Section 3: Charges Summary -->
            <div class="section">
                <h2>Charges Summary</h2>
                <table>
                    @if (!empty($rental->percentage))
                        <tr>
                            <td class="label">Tax (%):</td>
                            <td style="text-align: right;">{{ $rental->percentage }} %</td>
                        </tr>
                    @endif
                    @if (!empty($rental->tax_invoice_id))
                        <tr>
                            <td class="label">Tax Price (LKR):</td>
                            <td style="text-align: right;">{{ $rental->taxInvoice->tax_paid }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="label">Rental Cost (LKR):</td>
                        <td style="text-align: right;">{{ $rental->rental_cost }}</td>
                    </tr>
                    @if (!empty($rental->late_return_fee))
                        <tr>
                            <td class="label">Late Return Fee (LKR):</td>
                            <td style="text-align: right;">{{ $rental->late_return_fee }}</td>
                        </tr>
                    @endif
                    @if (!empty($rental->damage_fee))
                        <tr>
                            <td class="label">Damage Fee (LKR):</td>
                            <td style="text-align: right;">{{ $rental->damage_fee }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="label">Total Cost (LKR):</td>
                        <td style="text-align: right;">{{ $rental->total_cost ?? '0' }}</td>
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
                        <td style="text-align: right;">{{ $rental->taxInvoice->bill_issued_date }}</td>
                    </tr>
                    <tr>
                        <td class="label">Paid Amount (LKR):</td>
                        <td style="text-align: right;">{{ $rental->paid_amount ?? '0' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Advance Amount (LKR):</td>
                        <td style="text-align: right;">{{ $rental->advance_amount ?? '0' }}</td>
                    </tr>
                    <tr>
                        <td class="label">Due Amount (LKR):</td>
                        <td style="text-align: right;">{{ $rental->due_amount ?? '0' }}</td>
                    </tr>
                </table>
            </div>

            <!-- Footer Section -->
            <div class="footer">
                <p class="prepared-by">Prepared by: {{ $rental->user->name }}</p>
                <p>Thank you for choosing Premium Battery. We hope you had a pleasant stay!</p>

            </div>
        </div>

        <script>
            window.print(); // Automatically trigger print dialog

            // After printing, redirect to the bookings list
            window.onafterprint = function() {
                window.location.href =
                    "{{ request()->query('ref') === 'view' ? route('rentals.show', $rental->id) : route('rentals.index') }}";
            };
        </script>

    </body>

</html>

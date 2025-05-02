<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Customer Invoice</title>
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
                        alt="Company Logo" style="width: 100px; height: auto;">
                </div>
                <div class="company-info">
                    <h1>{{ $companyDetails->company_name ?? '' }}</h1>
                    <p>{{ $companyDetails->address ?? '' }}</p>
                    <p>{{ $companyDetails->email ?? '' }}</p>
                    <p>{{ $companyDetails->contact ?? '' }}</p>
                </div>
            </div>

            <!-- Date and Invoice Number -->
            <div class="section" style="display: flex; justify-content: space-between;">
                <p><strong>Date:</strong> {{ $currentDateTime }}</p>
                <p><strong>Invoice No:</strong> INV{{ now()->format('YmdHis') }}</p>
            </div>

            <!-- Customer Details -->
            <div class="section">
                <h2>Customer Details</h2>
                <table>
                    <tr>

                        <td><strong>Name:</strong></td>
                        <td>{{ $customer->first_name ?? '' }} {{ $customer->last_name ?? '' }}</td>
                        <td><strong>Contact:</strong></td>
                        <td>{{ $customer?->phone_number ?? '' }}</td>

                    </tr>
                </table>
            </div>

            <!-- Order Details -->
            <div class="section">
                <h2>Order Details</h2>
                <table>
                    <tr>
                        <th>Order Type</th>
                        <th>Order Date</th>
                        <th>Total Cost (LKR)</th>
                        <th>Paid (LKR)</th>
                        <th>Due (LKR)</th>
                    </tr>

                    @foreach ($batteryOrders as $order)
                        <tr>
                            <td>Battery</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ number_format($order->total_price, 2) }}</td>
                            <td>{{ number_format($order->paid_amount, 2) }}</td>
                            <td>{{ number_format($order->due_amount, 2) }}</td>
                        </tr>
                    @endforeach

                    @foreach ($replacementOrders as $order)
                        <tr>
                            <td>Replacement</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>{{ number_format($order->total_price, 2) }}</td>
                            <td>{{ number_format($order->paid_amount, 2) }}</td>
                            <td>{{ number_format($order->due_amount, 2) }}</td>
                        </tr>
                    @endforeach

                    @foreach ($lubricantOrders as $order)
                        <tr>
                            <td>Lubricant</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>{{ number_format($order->total_price, 2) }}</td>
                            <td>{{ number_format($order->paid_amount, 2) }}</td>
                            <td>{{ number_format($order->due_amount, 2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <!-- Payment Details -->
            <div class="section">
                <h2>Payment Details</h2>
                <table>
                    <tr>
                        <td><strong>Payment Type:</strong></td>
                        <td>
                            {{ $payment_type ?? 'N/A' }}
                        </td>

                    </tr>
                    <tr>
                        <td><strong>Total Paid (LKR):</strong></td>
                        <td>{{ number_format($batteryOrders->sum('paid_amount') + $replacementOrders->sum('paid_amount') + $lubricantOrders->sum('paid_amount'), 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Total Due (LKR):</strong></td>
                        <td>{{ number_format($batteryOrders->sum('due_amount') + $replacementOrders->sum('due_amount') + $lubricantOrders->sum('due_amount'), 2) }}
                        </td>
                    </tr>
                </table>
            </div>



            <!-- Footer Section -->
            <div class="footer">
                <p><strong>Prepared By:</strong> {{ auth()->user()->name }}</p>
                <p>Thank you for your business!</p>
            </div>
        </div>

        <script>
            window.print();
            window.onafterprint = function() {
                window.location.href = "{{ route('customers.index') }}";
            };
        </script>

    </body>

</html>

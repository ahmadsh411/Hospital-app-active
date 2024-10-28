@extends('Dashboard.layouts.Admin.master')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

    <style>
        .receipt-container {
            width: 100%;
            max-width: 900px;
            border: 2px solid #333;
            padding: 30px;
            margin: 20px auto;
            background-color: #f9f9f9;
            font-family: 'Cairo', sans-serif;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .receipt-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
            color: #4a4a4a;
        }

        .receipt-header p {
            margin: 0;
            font-size: 16px;
            color: #777;
        }

        .receipt-body {
            padding: 20px 0;
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .receipt-info {
            display: inline-block;
            font-size: 18px;
            font-weight: bold;
            padding: 8px;
            border-bottom: 1px dotted #666;
            color: #333;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .receipt-footer {
            margin-top: 40px;
        }

        .signature-line {
            width: 100%;
            height: 40px;
            border-bottom: 2px solid #333;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        @media print {
            body * {
                visibility: hidden;
            }

            #printable-receipt, #printable-receipt * {
                visibility: visible;
            }

            #printable-receipt {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                box-shadow: none;
                border: none;
            }

            .text-center, .text-center * {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="receipt-container" id="printable-receipt">
            <div class="receipt-header">
                <div class="receipt-title">سند قبض</div>
                <h2>شركة البركة</h2>
                <p>123 الشارع الرئيسي، المدينة، الدولة</p>
            </div>

            <div class="receipt-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="beneficiary-name">اسم المستفيد:</label>
                        <span class="receipt-info" id="beneficiary-name">{{ $payment->patient->name }}</span>
                    </div>
                    <div class="col-md-6 text-right">
                        <label for="receipt-date">التاريخ:</label>
                        <span class="receipt-info" id="receipt-date">{{ $payment->date }}</span>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-8">
                        <label for="description">الوصف:</label>
                        <span class="receipt-info" id="description">{{ $payment->description }}</span>
                    </div>
                    <div class="col-md-4 text-right">
                        <label for="amount">المبلغ:</label>
                        <span class="receipt-info" id="amount">{{ $payment->debit }}</span>
                    </div>
                </div>
            </div>

            <div class="receipt-footer mt-5">
                <div class="row">
                    <div class="col-md-6">
                        <label for="employee-name">اسم الموظف:</label>
                        <span class="receipt-info" id="employee-name"></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <label for="signature">التوقيع:</label>
                        <div class="signature-line" id="signature"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- زر الطباعة -->
        <div class="text-center mt-4">
            <button onclick="printReceipt()" class="btn btn-primary">طباعة السند</button>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function printReceipt() {
            window.print();
        }
    </script>
@endsection

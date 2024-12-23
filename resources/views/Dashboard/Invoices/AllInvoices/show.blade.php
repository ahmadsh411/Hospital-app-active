@extends('Dashboard.layouts.Admin.master')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

    <style>
        .receipt-container {
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border: 2px solid #333;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-family: 'Cairo', sans-serif;
        }

        .receipt-header, .receipt-footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }

        .receipt-body {
            padding: 20px 0;
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            margin-bottom: 40px;
        }

        .row {
            margin-bottom: 15px;
            justify-content: space-between;
        }

        .receipt-info {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            padding: 8px;
            border-bottom: 1px dotted #666;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .text-right {
            text-align: right;
        }

        .signature-line {
            border-bottom: 2px solid #333;
            height: 40px;
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
                box-shadow: none;
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
                <div class="receipt-title">{{ __('messages.Invoice') }}</div>
                <h2>{{ __('messages.Hospital') }}</h2>
                <p>{{ __('messages.Address') }}</p>
            </div>
            <div class="receipt-body">
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ __('messages.Beneficiary Name') }}:</label>
                        <span class="receipt-info">{{ $singleInvoice->patient->name }}</span>
                    </div>
                    <div class="col-md-4 text-right">
                        <label>{{ __('messages.Date') }}:</label>
                        <span class="receipt-info">{{ $singleInvoice->invoice_date }}</span>
                    </div>
                    @if ($singleInvoice->group)
                        <div class="col-md-4">
                            <label>{{ __('messages.Service Group') }}:</label>
                            <span class="receipt-info">{{ $singleInvoice->group->name }}</span>
                        </div>
                        <div class="col-md-4">
                            <label>{{ __('messages.Service Name') }}:</label>
                            @foreach ($singleInvoice->group->service_group as $service)
                                <span class="receipt-info">{{ $service->name }}</span>
                            @endforeach
                        </div>
                    @else
                        <div class="col-md-4">
                            <label>{{ __('messages.Service Name') }}:</label>
                            <span class="receipt-info">{{ $singleInvoice->service->name }}</span>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>{{ __('messages.Doctor Name') }}:</label>
                        <span class="receipt-info">{{ $singleInvoice->doctor->name }}</span>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('messages.Section') }}:</label>
                        <span class="receipt-info">{{ $singleInvoice->section->name }}</span>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <label>{{ __('messages.Discount Value') }}:</label>
                        <span class="receipt-info">{{ number_format($singleInvoice->discount_value, 2) }} {{ __('messages.Currency') }}</span>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('messages.Tax Rate') }}:</label>
                        <span class="receipt-info">{{ $singleInvoice->tax_rate }}%</span>
                    </div>
                    <div class="col-md-4 text-right">
                        <label>{{ __('messages.Total with Tax') }}:</label>
                        <span class="receipt-info">{{ number_format($singleInvoice->tot_with_tax, 2) }} {{ __('messages.Currency') }}</span>
                    </div>
                </div>
            </div>
            <div class="receipt-footer">
                <div class="row">
                    <div class="col-md-6">
                        <label>{{ __('messages.Employee Name') }}:</label>
                        <span class="receipt-info"></span>
                    </div>
                    <div class="col-md-6 text-right">
                        <label>{{ __('messages.Signature') }}:</label>
                        <div class="signature-line"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-4">
            <button onclick="printReceipt()" class="btn btn-primary">{{ __('messages.Print Invoice') }}</button>
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

@extends('Dashboard.layouts.Admin.master')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/ List</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                         data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @php
        $i = 1;
    @endphp
    @include('Dashboard.messages_allert')

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createInvoiceModal">
        Create New Invoice
    </button>
    <br><br><br><br>

    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Invoice List</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">Example of Invoice data displayed in a table..</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered text-md-nowrap">
                            <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Patient Name</th>
                                <th>ID Number</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Invoice Date</th>
                                <th>Doctor</th>
                                <th>Section</th>
                                <th>Service</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Total (with Tax)</th>
                                <th>Status</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $singleInvoice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><a href="#">{{ $singleInvoice->patient->name }}</a></td>
                                    <td>{{ $singleInvoice->patient->id_number }}</td>
                                    <td>{{ $singleInvoice->patient->email }}</td>
                                    <td>{{ $singleInvoice->patient->gender->gender_name }}</td>
                                    <td>{{ $singleInvoice->invoice_date }}</td>
                                    <td>{{ $singleInvoice->doctor->name }}</td>
                                    <td>{{ $singleInvoice->section->name }}</td>
                                    <td>{{ $singleInvoice->multiservice->name }}</td>
                                    <td>${{ number_format($singleInvoice->price, 2) }}</td>
                                    <td>${{ number_format($singleInvoice->discount_value, 2) }}</td>
                                    <td>${{ number_format($singleInvoice->tot_with_tax, 2) }}</td>
                                    <td>{{$singleInvoice->type==1?"Paid":"UnPaid"}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" onclick="func1()">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <script>
                                            function func1() {
                                                window.location.href = "{{route('group-invoices.edit', ['group_invoice' => $singleInvoice->id])}}";
                                            }
                                        </script>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteInvoice{{$singleInvoice->id}}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" onclick="show()">
                                            <i class="fas fa-print"></i>
                                        </button>
                                        <script>
                                            function show() {
                                                window.location.href = "{{route('group-invoices.show',['group_invoice'=>$singleInvoice->id])}}"
                                            }
                                        </script>
                                    </td>
                                </tr>
                                @include('Dashboard.Invoices.GroupInvoices.delete')
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    @include('Dashboard.Invoices.GroupInvoices.create')
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

@section('js')
    <!-- Internal Data tables -->

    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
    <!-- JavaScript to handle calculations -->

@endsection

@extends('Dashboard.layouts.Doctor.master_doctor')
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
                <h4 class="content-title mb-0 my-auto">{{__('messages.invoices')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('messages.doctor_invoices')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @php
        $i=1;
    @endphp

    @include('Dashboard.messages_allert')

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{ __('messages.invoices_table') }}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.patient_name') }}</th>
                                <th>{{ __('messages.invoice_type') }}</th>
                                <th>{{ __('messages.service_or_group') }}</th>
                                <th>{{ __('messages.section') }}</th>
                                <th>{{ __('messages.invoice_date') }}</th>
                                <th>{{ __('messages.price') }}</th>
                                <th>{{ __('messages.discount') }}</th>
                                <th>{{ __('messages.tax_rate') }}</th>
                                <th>{{ __('messages.tax_value') }}</th>
                                <th>{{ __('messages.total_with_tax') }}</th>
                                <th>{{ __('messages.status') }}</th>
                                <th>{{ __('messages.invoice_status') }}</th>
                                <th>{{ __('messages.reviews_date') }}</th>
                                <th>{{ __('messages.operations') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>
                                        <a href="{{route('patient.details',['id'=>$invoice->patient->id])}}">
                                            {{$invoice->patient->name}}
                                        </a>
                                    </td>
                                    <td>
                                        @if($invoice->invoice_type == 1)
                                            <span class="badge badge-success">{{ __('messages.group_invoice') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('messages.single_invoice') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $invoice->service ? $invoice->service->name : ($invoice->group ? $invoice->group->name : __('messages.not_available')) }}</td>
                                    <td>{{$invoice->section->name}}</td>
                                    <td>{{$invoice->invoice_date}}</td>
                                    <td>{{number_format($invoice->price, 2)}}</td>
                                    <td>{{number_format($invoice->discount_value, 2)}}</td>
                                    <td>{{$invoice->tax_rate}}</td>
                                    <td>{{$invoice->tax_value}}</td>
                                    <td>{{number_format($invoice->tot_with_tax, 2)}}</td>
                                    <td>
                                        @if($invoice->type == 1)
                                            <span class="badge badge-success">{{ __('messages.paid') }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ __('messages.unpaid') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($invoice->invoice_status == 1)
                                            <span class="badge badge-info">{{ __('messages.completed') }}</span>
                                        @elseif ($invoice->invoice_status == 0)
                                            <span class="badge badge-danger">{{ __('messages.in_progress') }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ __('messages.under_review') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($invoice->invoice_status==2)
                                            @foreach($invoice->Medical_Diagnosises as $medical)
                                                @if($medical->invoice_id==$invoice->id)
                                                    <p>{{$medical->review_date}}</p>
                                                @endif
                                            @endforeach
                                        @else
                                            <span><strong>{{ __('messages.no_reviews') }}</strong></span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                {{ __('messages.operations') }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item" type="button" data-toggle="modal"
                                                        data-target="#addDiagnosisModal{{$invoice->patient->id}}">
                                                    <i class="fas fa-notes-medical text-info"></i> {{ __('messages.add_diagnosis') }}
                                                </button>
                                                <button class="dropdown-item" type="button" data-toggle="modal"
                                                        data-target="#addReview{{$invoice->id}}">
                                                    <i class="fas fa-calendar-check text-primary"></i> {{ __('messages.add_review') }}
                                                </button>

                                                <button class="dropdown-item" type="button" data-toggle="modal"
                                                        data-target="#addlaboratoryModal{{ $invoice->id }}">
                                                    <i class="fas fa-microscope"></i> {{ __('messages.refer_to_lab') }}
                                                </button>
                                                <button class="dropdown-item" type="button" data-toggle="modal"
                                                        data-target="#addRayModal{{$invoice->id}}" onclick="x_ray()">
                                                    <i class="fas fa-x-ray"></i> {{ __('messages.refer_to_xray') }}
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include('Dashboard.Doctors.DoctorDashboard.Invoices.NotesMedical')
                                @include('Dashboard.Doctors.DoctorDashboard.Invoices.addReview')
                                @include('Dashboard.Doctors.DoctorDashboard.Invoices.add_X_rays')
                                @include('Dashboard.Doctors.DoctorDashboard.Invoices.Laboratory.add')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection

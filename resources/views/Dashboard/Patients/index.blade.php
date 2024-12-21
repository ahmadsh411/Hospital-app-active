@extends('Dashboard.layouts.Admin.master')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <style>
        /* تحسين عرض القائمة المنسدلة */
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .dropdown-menu a {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            font-size: 14px;
            transition: background-color 0.2s ease, transform 0.2s ease;
        }

        .dropdown-menu a i {
            margin-right: 10px;
        }

        .dropdown-menu a.edit-item:hover {
            background-color: #007bff;
            color: white;
            transform: translateX(5px); /* تحريك النص قليلاً لليمين */
        }

        .dropdown-menu a.delete-item:hover {
            background-color: #dc3545;
            color: white;
            transform: translateX(5px); /* تحريك النص قليلاً لليمين */
        }

        /* تأثير لطيف عند عرض القائمة */
        .dropdown-menu.show {
            opacity: 0;
            transform: translateY(-10px);
            animation: fadeIn 0.3s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('patients.patirnt') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('doctors.ALL') }}</span>
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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPatient">
        {{ __('patients.create_patient') }}
    </button>
    <br><br><br><br>

    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{ __('patients.patient_name') }}</th>
                                <th class="border-bottom-0">{{ __('patients.id_number') }}</th>
                                <th class="border-bottom-0">{{ __('patients.email') }}</th>
                                <th class="border-bottom-0">{{ __('patients.gender') }}</th>
                                <th class="border-bottom-0">{{ __('patients.operations') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        <a href="{{route('patient-hospital.show',['patient_hospital'=>$patient->id])}}">{{ $patient->name }}</a>
                                    </td>
                                    <td>{{$patient->id_number}}</td>
                                    <td>{{ $patient->email }}</td>
                                    <td>{{ $patient->gender->gender_name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#update{{ $patient->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                                data-target="#delete{{ $patient->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @include('Dashboard.Patients.update')
                                @include('Dashboard.Patients.delete')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    @include('Dashboard.Patients.add')

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
@endsection

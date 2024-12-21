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
                <h4 class="content-title mb-0 my-auto">{{ __('messages.Insurance') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.ListofInsurances') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @php $i = 1; @endphp
    @include('Dashboard.messages_allert')

    <!-- زر لإضافة تأمين جديد -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">
        {{ __('messages.add_insurance') }}
    </button>

    <br><br>

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{ __('messages.insurance_table') }}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('messages.company_name') }}</th>
                                <th>{{ __('messages.company_code') }}</th>
                                <th>{{ __('messages.email') }}</th>
                                <th>{{ __('messages.rate') }}</th>
                                <th>{{ __('messages.status') }}</th>
                                <th>{{ __('messages.descriptions') }}</th>
                                <th>{{ __('messages.created_at') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($insurances as $insurance)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $insurance->company_name }}</td>
                                    <td>{{ $insurance->company_code }}</td>
                                    <td>{{ $insurance->company_email }}</td>
                                    <td>{{ $insurance->company_rate }}</td>
                                    <td style="background-color: {{ $insurance->status == 1 ? 'green' : 'red' }}; color: white;">
                                        {{ $insurance->status==1 ? __('messages.active') : __('messages.inactive') }}
                                    </td>
                                    <td>{{ $insurance->notes }}</td>
                                    <td>{{ $insurance->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton{{$insurance->id}}" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                {{ __('messages.actions') }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="#update{{$insurance->id}}">
                                                <!-- زر التعديل -->
                                                <a class="dropdown-item edit-item" href="#" data-toggle="modal"
                                                   data-target="#updateInsuranceModal{{$insurance->id}}">
                                                    <i class="fas fa-edit"></i> {{ __('messages.edit') }}
                                                </a>
                                                <!-- زر الحذف -->
                                                <a class="dropdown-item delete-item" href="#" data-toggle="modal"
                                                   data-target="#deleteInsuranceModal{{$insurance->id}}">
                                                    <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include('Dashboard.Insurances.update')
                                @include('Dashboard.Insurances.delete')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('Dashboard.Insurances.add')
@endsection


@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Internal Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection


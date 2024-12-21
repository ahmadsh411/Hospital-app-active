@extends('Dashboard.layouts.Staff.master_staff')
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
    <!-- Breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <!-- عنوان الصفحة -->
                <h4 class="content-title mb-0 my-auto">{{ __('messages.staff') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.all') }}</span>
            </div>
        </div>

        <!-- عناصر التحكم -->
        <div class="d-flex my-xl-auto right-content">
            <!-- زر الفلتر -->
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2">
                    <i class="mdi mdi-filter-variant"></i>
                </button>
            </div>

            <!-- زر المفضلة -->
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2">
                    <i class="mdi mdi-star"></i>
                </button>
            </div>

            <!-- زر التحديث -->
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning btn-icon ml-2">
                    <i class="mdi mdi-refresh"></i>
                </button>
            </div>

            <!-- زر التاريخ -->
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">{{ __('messages.current_date') }}</button>
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
    <!-- Breadcrumb -->
@endsection



@section('content')
    @php
        $i = 1;
    @endphp
    @include('Dashboard.messages_allert')

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">{{ __('messages.laboratory_table') }}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="laboratoryTable" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">{{ __('messages.description') }}</th>
                                <th class="border-bottom-0">{{ __('messages.doctor_name') }}</th>
                                <th class="border-bottom-0">{{ __('messages.status') }}</th>
                                <th class="border-bottom-0">{{ __('messages.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($laboratories as $laboratory)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $laboratory->description ?? __('messages.no_description') }}</td>
                                    <td>{{ $laboratory->doctor ? $laboratory->doctor->name : __('messages.not_available') }}</td>
                                    <td>{{ $laboratory->status ? __('messages.completed') : __('messages.not_completed') }}</td>
                                    <td>
                                        <a href="{{ route('staff.laboratory-edit', $laboratory->id) }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
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
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
@endsection

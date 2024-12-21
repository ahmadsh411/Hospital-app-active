@extends('Dashboard.layouts.Staff.master_staff')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <!-- عنوان التحاليل الطبية -->
                <h4 class="content-title mb-0 my-auto">{{ __('messages.medical_analysis') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.all') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection


@section('content')
    <div class="container">
        <h2>{{ __('messages.laboratories_list_for_staff') }}: {{ auth('staff')->user()->name }}</h2>

        {{-- التحقق من وجود فحوصات --}}
        @if($laboratories->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ __('messages.patient_name') }}</th>
                        <th>{{ __('messages.description') }}</th>
                        <th>{{ __('messages.status') }}</th>
                        <th>{{ __('messages.examination_date') }}</th>
                        <th>{{ __('messages.staff_name') }}</th>
                        <th>{{ __('messages.staff_description') }}</th>
                        <th>{{ __('messages.details') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($laboratories as $ray)
                        <tr>
                            <td>{{ $ray->patient->name }}</td>
                            <td>{{ $ray->description ?? __('messages.no_description') }}</td>
                            <td>{{ $ray->status ? __('messages.completed') : __('messages.not_completed') }}</td>
                            <td>{{ $ray->staff_date }}</td>
                            <td>{{ $ray->staff_name ?? __('messages.not_available') }}</td>
                            <td>{{ $ray->staff_description ?? __('messages.not_available') }}</td>
                            <td>
                                <a href="{{ route('staff.laboratory-show-information', $ray->id) }}" class="btn btn-info">
                                    {{ __('messages.view_details') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning">
                <p>{{ __('messages.no_laboratories_found') }}</p>
            </div>
        @endif
    </div>
@endsection


@section('js')
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
@endsection

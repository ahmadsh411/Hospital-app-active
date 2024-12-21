@extends('Dashboard.layouts.Admin.master')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body { background-color: #f9faff; }
        .profile-card { max-width: 600px; margin: 0 auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); }
        .profile-header { background-color: #007bff; color: #fff; text-align: center; padding: 30px 15px; border-top-left-radius: 12px; border-top-right-radius: 12px; }
        .profile-img { width: 120px; height: 120px; border-radius: 50%; border: 4px solid #fff; margin-top: -60px; }
        .profile-body { padding: 20px; font-size: 1.1rem; }
        .profile-item { display: flex; align-items: center; margin-bottom: 15px; }
        .profile-item i { font-size: 1.3rem; color: #007bff; margin-right: 10px; }
        .btn-back { background-color: #6c757d; color: #fff; transition: background 0.3s ease; }
        .btn-back:hover { background-color: #5a6268; }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('messages.admin_page') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.profile') }}</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            <button type="button" class="btn btn-warning btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-primary">{{ __('messages.refresh') }}</button>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
    @include('Dashboard.messages_allert')
@endsection

@section('content')
    <div class="container mt-5">
        <div class="profile-card card animate__animated animate__fadeIn">
            <div class="profile-header">
                <h3>{{ $admin->name }}</h3>
                <p class="mb-0">{{ $admin->email }}</p>
            </div>
            <div class="profile-body">
                <div class="profile-item">
                    <i class="mdi mdi-calendar-clock"></i>
                    <span><strong>{{ __('messages.creation_date') }}:</strong> {{ $admin->created_at->format('Y-m-d') }}</span>
                </div>
                <div class="profile-item">
                    <i class="mdi mdi-update"></i>
                    <span><strong>{{ __('messages.last_update') }}:</strong> {{ $admin->updated_at->format('Y-m-d') }}</span>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-back mt-3 animate__animated animate__bounceIn">
                    {{ __('messages.back_to_dashboard') }}
                </a>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('.btn-back').hover(function() {
                $(this).addClass('animate__pulse');
            }, function() {
                $(this).removeClass('animate__pulse');
            });
        });
    </script>
@endsection

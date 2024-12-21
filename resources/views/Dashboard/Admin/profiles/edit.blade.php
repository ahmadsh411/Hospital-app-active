@extends('Dashboard.layouts.Admin.master')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        body { background-color: #f9faff; }
        .edit-card { max-width: 600px; margin: 50px auto; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 20px; }
        .form-label { font-weight: bold; color: #333; }
        .btn-save { background-color: #28a745; color: #fff; transition: background 0.3s ease; }
        .btn-save:hover { background-color: #218838; }
        .btn-cancel { background-color: #6c757d; color: #fff; transition: background 0.3s ease; }
        .btn-cancel:hover { background-color: #5a6268; }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('messages.admin_page') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.edit_profile') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="container">
        <div class="edit-card card animate__animated animate__fadeIn">
            <div class="card-header bg-primary text-white text-center">
                <h5>{{ __('messages.edit_admin_data') }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <!-- حقل الاسم -->
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('messages.full_name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $admin->name }}" required>
                    </div>

                    <!-- حقل البريد الإلكتروني -->
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('messages.email') }}</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $admin->email }}" required>
                    </div>

                    <!-- حقل كلمة المرور الجديدة -->
                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('messages.new_password') }} ({{ __('messages.optional') }})</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('messages.leave_blank_if_no_change') }}">
                    </div>

                    <!-- أزرار الحفظ والإلغاء -->
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-save animate__animated animate__pulse">{{ __('messages.save_changes') }}</button>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-cancel ml-3">{{ __('messages.cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
            // حركة على زر الحفظ عند مرور الماوس
            $('.btn-save').hover(
                function() { $(this).addClass('animate__heartBeat'); },
                function() { $(this).removeClass('animate__heartBeat'); }
            );
        });
    </script>
@endsection

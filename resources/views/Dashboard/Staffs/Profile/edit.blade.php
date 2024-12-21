@extends('Dashboard.layouts.Staff.master_staff')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <style>
        /* تحسينات بصرية */
        .card-header h2 { animation: fadeIn 1s ease-in-out; }
        .card { transition: transform 0.3s; }
        .card:hover { transform: scale(1.01); }
        .btn-primary, .btn-secondary { border-radius: 20px; }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('messages.staff') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.edit_profile') }}</span>
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
                <button type="button" class="btn btn-warning btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate">
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

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-gradient text-white text-center">
                        <h2 class="font-weight-bold">{{ __('messages.edit_profile') }}</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('staff.update-profile') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                    <input type="text" class="form-control border-primary" id="name" name="name" value="{{ $staff->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">{{ __('messages.email') }}</label>
                                    <input type="email" class="form-control border-primary" id="email" name="email" value="{{ $staff->email }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">{{ __('messages.phone') }}</label>
                                    <input type="text" class="form-control border-primary" id="phone" name="phone" value="{{ $staff->phone }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">{{ __('messages.address') }}</label>
                                    <input type="text" class="form-control border-primary" id="address" name="address" value="{{ $staff->address }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender_id" class="form-label">{{ __('messages.gender') }}</label>
                                    <select class="form-control border-primary" id="gender_id" name="gender_id" required>
                                        @foreach($genders as $gender)
                                            <option value="{{ $gender->id }}" {{ $staff->gender_id == $gender->id ? 'selected' : '' }}>
                                                {{ $gender->gender_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="section_id" class="form-label">{{ __('messages.section') }}</label>
                                    <input class="form-control border-primary" id="section_id" name="section_id" required value="{{ $staff->section->name }}" readonly>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4">{{ __('messages.save_changes') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/select2/js/select2.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script>
        $(document).ready(function() {
            notif({ msg: "مرحبا بك في صفحة التعديل!", type: "info" });
        });
    </script>
@endsection

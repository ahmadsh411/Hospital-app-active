@extends('Dashboard.layouts.Admin.master')

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
                <h4 class="content-title mb-0 my-auto">Staff</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Edit Profile</span>
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
                        <h2 class="font-weight-bold">تعديل الملف الشخصي</h2>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{route('staff.update-profile')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">الاسم</label>
                                    <input type="text" class="form-control border-primary" id="name" name="name" value="{{ $staff->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">البريد الإلكتروني</label>
                                    <input type="email" class="form-control border-primary" id="email" name="email" value="{{ $staff->email }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">رقم الهاتف</label>
                                    <input type="text" class="form-control border-primary" id="phone" name="phone" value="{{ $staff->phone }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">العنوان</label>
                                    <input type="text" class="form-control border-primary" id="address" name="address" value="{{ $staff->address }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="gender_id" class="form-label">الجنس</label>
                                    <select class="form-select border-primary" id="gender_id" name="gender_id" required>
                                        @foreach($genders as $gender)
                                            <option value="{{ $gender->id }}" {{ $staff->gender_id == $gender->id ? 'selected' : '' }}>
                                                {{ $gender->gender_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="section_id" class="form-label">القسم</label>
                                    <select class="form-select border-primary" id="section_id" name="section_id" required>
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}" {{ $staff->section_id == $section->id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary px-4">حفظ التعديلات</button>
                                <a href="{{ url('/staff') }}" class="btn btn-secondary px-4">إلغاء</a>
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

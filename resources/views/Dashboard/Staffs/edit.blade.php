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
                <h4 class="content-title mb-0 my-auto">Staff</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/ All</span>
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

    <form action="{{ route('staff-hospital.update', ['staff_hospital'=>$staff->id]) }}" method="POST">
        @csrf
        @method('PUT') <!-- نستخدم PUT للتعديل -->

        <div class="row">
            <!-- Name Field -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $staff->name }}" required>
                </div>
            </div>

            <!-- Email Field -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $staff->email }}"
                           required>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Password Field -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password (Leave blank if not changing)</label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Leave blank if not changing">
                </div>
            </div>

            <!-- Address Field -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $staff->address }}"
                           required>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Phone Field -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $staff->phone }}"
                           required>
                </div>
            </div>

            <!-- Gender Field -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="gender_id">Gender</label>
                    <select class="form-control select2" id="gender_id" name="gender_id" required>
                        @foreach($genders as $gender)
                            <option value="{{ $gender->id }}" {{ $staff->gender_id == $gender->id ? 'selected' : '' }}>
                                {{ $gender->gender_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Section Field -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="section_id">Section</label>
                    <select class="form-control select2" id="section_id" name="section_id" required>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ $staff->section_id == $section->id ? 'selected' : '' }}>
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Appointments Field -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="appointment_id">Appointments</label>
                    <select class="form-control select2" id="appointment_id" name="appointment_ids[]"
                            multiple="multiple" required>
                        @foreach($appointments as $appointment)
                            <option value="{{ $appointment->id }}" {{ in_array($appointment->id, $staff->appointments->pluck('id')->toArray()) ? 'selected' : '' }}>
                                {{ $appointment->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Staff Member</button>
        </div>
    </form>

@endsection





@section('js')
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
@endsection


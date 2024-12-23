@extends('Dashboard.layouts.Admin.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('Dashboard/plugins/sumoselect/sumoselect-rtl.css') }}">
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <!-- Internal Select2 css -->
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <!--Internal  Datetimepicker-slider css -->
    <link href="{{URL::asset('Dashboard/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
    <!-- Internal Spectrum-colorpicker css -->
    <link href="{{URL::asset('Dashboard/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">

    @section('title')
        {{ trans('doctors.edit_doctor') }}
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('doctors.doctors') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('doctors.edit_doctor') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @include('Dashboard.messages_allert')

    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('doctor.update', ['id' => $doctor->id]) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="pd-30 pd-sm-40 bg-gray-200">
                            <div>
                                @if($doctor->image)
                                    <img style="border-radius:20%" src="{{ Url::asset('Dashboard/img/doctors/' . $doctor->image->filename) }}" height="150px" width="150px" alt="">
                                @else
                                    <img style="border-radius:50%" src="{{ Url::asset('Dashboard/img/doctors/Doctors_For_Men.avif') }}" height="50px" width="50px" alt="">
                                @endif
                            </div>
                            <br><br>

                            <!-- اسم الطبيب -->
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">{{ trans('doctors.name') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" name="name" value="{{ $doctor->name }}" type="text">
                                </div>
                            </div>

                            <!-- البريد الإلكتروني -->
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">{{ trans('doctors.email') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{ $doctor->email }}" name="email" type="email">
                                </div>
                            </div>

                            <!-- رقم الهاتف -->
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">{{ trans('doctors.phone') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input class="form-control" value="{{ $doctor->phone_number }}" name="phone_number" type="tel">
                                    <input class="form-control" value="{{ $doctor->id }}" name="id" type="hidden">
                                </div>
                            </div>

                            <!-- القسم -->
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">{{ trans('doctors.section') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select name="section_id" class="form-control SlectBox">
                                        @foreach($sections as $section)
                                            <option value="{{ $section->id }}" {{ $section->id == $doctor->section_id ? 'selected' : '' }}>
                                                {{ $section->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- المواعيد -->
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">{{ trans('doctors.appointments') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <select multiple="multiple" class="testselect2" name="appointments[]">
                                        @php
                                            $doctorAppointments = $doctor->appointments->pluck('id')->toArray();
                                        @endphp
                                        @foreach($appointments as $appointment)
                                            <option value="{{ $appointment->id }}" @if(in_array($appointment->id, $doctorAppointments)) selected @endif>
                                                {{ $appointment->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- صورة الطبيب -->
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-1">
                                    <label for="exampleInputEmail1">{{ trans('doctors.doctor_photo') }}</label>
                                </div>
                                <div class="col-md-11 mg-t-5 mg-md-t-0">
                                    <input type="file" accept="image/*" name="photo" onchange="loadFile(event)">
                                    <img style="border-radius:50%" width="150px" height="150px" id="output"/>
                                </div>
                            </div>

                            <!-- زر الإرسال -->
                            <button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ trans('doctors.submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <script>
        var loadFile = function (event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function () {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('Dashboard/js/select2.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/advanced-form-elements.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('Dashboard/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection

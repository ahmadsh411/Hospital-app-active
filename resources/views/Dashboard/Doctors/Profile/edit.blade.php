@extends('Dashboard.layouts.Doctor.master_doctor')
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
                <h4 class="content-title mb-0 my-auto">{{ __('messages.profile') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.edit') }}</span>
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
    <div class="container my-5">
        <div class="card shadow-lg border-0">
            <!-- العنوان مع زر العودة -->
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="mb-0">{{ __('messages.edit_profile') }}</h3>
                <a href="{{ route('doctor.profile') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left"></i> {{ __('messages.back') }}
                </a>
            </div>

            <!-- نموذج التعديل -->
            <div class="card-body">
                <form action="{{ route('doctor.profile.update') }}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf

                    <!-- الاسم -->
                    <div class="form-group mb-3">
                        <label for="name" class="form-label"><i class="fas fa-user"></i> {{ __('messages.name') }}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $doctor->name }}" required>
                        <div class="invalid-feedback">{{ __('messages.enter_full_name') }}</div>
                    </div>

                    <!-- البريد الإلكتروني -->
                    <div class="form-group mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> {{ __('messages.email') }}</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $doctor->email }}" required>
                        <div class="invalid-feedback">{{ __('messages.enter_valid_email') }}</div>
                    </div>

                    <!-- كلمة المرور -->
                    <div class="form-group mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> {{ __('messages.password_optional') }}</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('messages.leave_blank') }}">
                    </div>

                    <!-- رقم الهاتف -->
                    <div class="form-group mb-3">
                        <label for="phone_number" class="form-label"><i class="fas fa-phone-alt"></i> {{ __('messages.phone_number') }}</label>
                        <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ $doctor->phone_number }}" required>
                        <div class="invalid-feedback">{{ __('messages.enter_phone_number') }}</div>
                    </div>

                    <!-- القسم -->
                    <div class="form-group mb-3">
                        <label for="section_id" class="form-label"><i class="fas fa-clinic-medical"></i> {{ __('messages.section') }}</label>
                        <input name="section_id" id="section_id" class="form-control" value="{{ $doctor->section->name }}" readonly required>
                        <div class="invalid-feedback">{{ __('messages.select_section') }}</div>
                    </div>

                    <!-- الصورة الشخصية -->
                    <div class="form-group mb-3 text-center">
                        <label for="photo" class="form-label d-block"><i class="fas fa-camera"></i> {{ __('messages.profile_photo') }}</label>
                        @if($doctor->image)
                            <img src="{{ asset('Dashboard/img/doctors/'.'/'.$doctor->image->filename) }}" alt="{{ __('messages.current_photo') }}" class="img-thumbnail mb-3" style="width: 150px; height: 150px;">
                        @else
                            <img src="{{ asset('Dashboard/6.jpg') }}" alt="{{ __('messages.default_photo') }}" class="img-thumbnail mb-3" style="width: 150px; height: 150px;">
                        @endif
                        <input type="file" name="photo" id="photo" class="form-control-file">
                        <small class="text-muted">{{ __('messages.select_new_photo') }}</small>
                    </div>

                    <!-- زر الحفظ مع حركة -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg save-btn">
                            <i class="fas fa-save"></i> {{ __('messages.save_changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- تأثيرات CSS -->
    <style>
        /* زر الحفظ بتأثير النبض */
        .save-btn {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .save-btn:hover {
            background-color: #28a745;
            transform: scale(1.05);
        }

        /* حركة حقول الإدخال */
        input:focus, select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
    </style>

    <!-- JavaScript للتحقق من المدخلات -->
    <script>
        (function () {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection


@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>


    {{--    //select all--}}
    <script>
        $(function () {
            jQuery("[name=select_all]").click(function (source) {
                checkboxes = jQuery("[name=delete_select]");
                for (var i in checkboxes) {
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>


    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = [];
                $("#example input[name=delete_select]:checked").each(function () {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_select').modal('show')
                    $('input[id="delete_select_id"]').val(selected);
                }
            });
        });
    </script>

@endsection

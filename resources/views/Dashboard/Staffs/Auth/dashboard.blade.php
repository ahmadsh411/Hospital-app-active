@extends('Dashboard.layouts.Staff.master_staff')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('Dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet"/>
    <!-- Maps css -->
    <link href="{{URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between align-items-center mb-4">
        <div class="left-content">
            <h2 class="main-content-title tx-24 mb-1">Hi, welcome back!</h2>
            <p class="text-muted mb-0">
                {{ __('messages.welcome', ['name' => auth('staff')->user()->name]) }}
            </p>

        </div>
        <div class="main-dashboard-header-center text-center">


            <!-- Font Awesome Icon for Admin -->
            <i class="fas fa-user fa-5x animated-icon"></i>
        </div>

        <!-- إضافة CSS للتغيير اللوني -->
        <style>
            @keyframes colorChange {
                0% {
                    color: #ff7e5f;
                }
                25% {
                    color: #feb47b;
                }
                50% {
                    color: #00c6ff;
                }
                75% {
                    color: #0072ff;
                }
                100% {
                    color: #ff7e5f;
                }
            }

            .animated-icon {
                animation: colorChange 4s infinite; /* يتغير اللون كل ثانيتين */
            }
        </style>

        <!-- تأكد من تضمين Font Awesome في الصفحة -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


        <div class="main-dashboard-header-right">
            <div class="card card-body p-3 shadow-sm">
                <label class="tx-13 mb-2 font-weight-bold">{{ __('messages.customer_ratings') }}</label>
                <div class="d-flex align-items-center">
                    <div class="main-star me-2">
                        <!-- Five Stars -->
                        <i class="typcn typcn-star active"></i>
                        <i class="typcn typcn-star active"></i>
                        <i class="typcn typcn-star active"></i>
                        <i class="typcn typcn-star active"></i>
                        <i class="typcn typcn-star active"></i>
                    </div>
                    <!-- Ratings Count -->
                    <span class="text-muted ms-2">({{ number_format(14873) }})</span>
                </div>
            </div>
        </div>

    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @if(auth('staff')->user() && auth('staff')->user()->section->id==3)
        <div class="row row-sm">
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="overflow-hidden card sales-card bg-primary-gradient">
                    <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                        <div>
                            <h2 class="mb-3 text-white tx-12">{{ __('messages.section') }}</h2>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex align-items-center">
                    <span class="icon-container">
                        <i class="fa fa-folder icon-effect"></i>
                    </span>
                                <div class="ml-3">
                                    <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                        {{ auth('staff')->user()->section->name }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <style>
                            .icon-container {
                                background-color: #3498db;
                                border-radius: 50%;
                                padding: 15px;
                                transition: transform 0.3s ease, background-color 0.3s ease;
                            }

                            .icon-effect {
                                color: #ffffff;
                                font-size: 1.5rem;
                            }

                            .icon-container:hover {
                                transform: scale(1.2);
                                background-color: #2980b9;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                    <span id="compositeline1"
                          class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="overflow-hidden card sales-card bg-success-gradient">
                    <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                        <div>
                            <h2 class="mb-3 text-white tx-12">{{ __('messages.completed_radiology_exams') }}</h2>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex align-items-center">
                    <span class="icon-container1">
                        <i class="fas fa-radiation icon-effect1"></i>
                    </span>
                                <div class="ml-3">
                                    <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                        {{
                                            \App\Models\Rays\Ray::whereNotNull('staff_id')->where('status', 1)->count()
                                        }} {{ __('messages.of_rays') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <style>
                            .icon-container1 {
                                background-color: #81c784;
                                border-radius: 50%;
                                padding: 15px;
                                transition: transform 0.3s ease, background-color 0.3s ease;
                            }

                            .icon-effect1 {
                                color: #ffffff;
                                font-size: 1.5rem;
                            }

                            .icon-container1:hover {
                                transform: scale(1.2);
                                background-color: #66bb6a;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                    <span id="compositeline22"
                          class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="overflow-hidden card sales-card bg-purple-gradient">
                    <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                        <div>
                            <h2 class="mb-3 text-white tx-12">{{ __('messages.radiology_transfers') }}</h2>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex align-items-center">
                    <span class="icon-container2">
                        <i class="fas fa-radiation icon-effect2"></i>
                    </span>
                                <div class="ml-3">
                                    <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                        {{ \App\Models\Rays\Ray::all()->count() }} {{ __('messages.of_transfers') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <style>
                            .icon-container2 {
                                background-color: #9c27b0;
                                border-radius: 50%;
                                padding: 15px;
                                transition: transform 0.3s ease, background-color 0.3s ease;
                            }

                            .icon-effect2 {
                                color: #ffffff;
                                font-size: 1.5rem;
                            }

                            .icon-container2:hover {
                                transform: scale(1.2);
                                background-color: #7b1fa2;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                    <span id="compositeline3"
                          class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="overflow-hidden card sales-card bg-secondary-gradient">
                    <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                        <div>
                            <h2 class="mb-3 text-white tx-12">{{ __('messages.pending_rays') }}</h2>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex align-items-center">
                    <span class="icon-container4">
                        <i class="fa fa-2x fa-syringe"></i>
                    </span>
                                <div class="ml-3">
                                    <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                        {{ \App\Models\Rays\Ray::where('status', 0)->count() }} {{ __('messages.of_rays') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <style>
                            .icon-container4 {
                                background-color: #e91e63; /* لون مختلف */
                                border-radius: 50%;
                                padding: 15px;
                                transition: transform 0.3s ease, background-color 0.3s ease;
                            }

                            .icon-effect4 {
                                color: #ffffff; /* لون الأيقونة */
                                font-size: 1.5rem;
                            }

                            .icon-container4:hover {
                                transform: scale(1.2);
                                background-color: #d81b60; /* لون جديد عند التحويم */
                                cursor: pointer;
                            }

                            .bg-primary-gradient {
                                background: linear-gradient(135deg, #ff9800, #ff5722); /* تدرج برتقالي */
                            }
                        </style>
                    </div>
                    <!-- إضافة عنصر السبان الذي يحتوي على بيانات الرسم البياني -->
                    <span id="compositeline4"
                          class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>


        </div>
    @elseif(auth('staff')->user() && auth('staff')->user()->section->id==2)

        <div class="row row-sm">
            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="overflow-hidden card sales-card bg-primary-gradient">
                    <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                        <div class="">
                            <h2 class="mb-3 text-white tx-12">{{ __('messages.section') }}</h2>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex align-items-center">
                    <span class="icon-container">
                        <i class="fa fa-folder icon-effect"></i>
                    </span>
                                <div class="ml-3"{{$staff=auth('staff')->user()}}>
                                    <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                        {{ $staff->section->name }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <style>
                            .icon-container {
                                background-color: #3498db;
                                border-radius: 50%;
                                padding: 15px;
                                transition: transform 0.3s ease, background-color 0.3s ease;
                            }

                            .icon-effect {
                                color: #ffffff;
                                font-size: 1.5rem;
                            }

                            .icon-container:hover {
                                transform: scale(1.2);
                                background-color: #2980b9;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                    <span id="compositeline1"
                          class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="overflow-hidden card sales-card bg-success-gradient">
                    <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                        <div>
                            <h2 class="mb-3 text-white tx-12">{{ __('messages.completed_laboratory_tests') }}</h2>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex align-items-center">
                    <span class="icon-container1">
                        <i class="fas fa-microscope fa-2x"></i>
                    </span>
                                <div class="ml-3">
                                    <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                        {{ \App\Models\Laboratories\Laboratory::whereNotNull('staff_id')->where('status', 1)->count() }} {{ __('messages.of_tests') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <style>
                            .icon-container1 {
                                background-color: #81c784;
                                border-radius: 50%;
                                padding: 15px;
                                transition: transform 0.3s ease, background-color 0.3s ease;
                            }

                            .icon-effect1 {
                                color: #ffffff;
                                font-size: 1.5rem;
                            }

                            .icon-container1:hover {
                                transform: scale(1.2);
                                background-color: #66bb6a;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                    <span id="compositeline22"
                          class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="overflow-hidden card sales-card bg-purple-gradient">
                    <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                        <div>
                            <h2 class="mb-3 text-white tx-12">{{ __('messages.laboratory_transfers') }}</h2>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex align-items-center">
                    <span class="icon-container2">
                        <i class="fas fa-microscope fa-2x"></i>
                    </span>
                                <div class="ml-3">
                                    <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                        {{ \App\Models\Laboratories\Laboratory::all()->count() }} {{ __('messages.of_transfers') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <style>
                            .icon-container2 {
                                background-color: #9c27b0;
                                border-radius: 50%;
                                padding: 15px;
                                transition: transform 0.3s ease, background-color 0.3s ease;
                            }

                            .icon-effect2 {
                                color: #ffffff;
                                font-size: 1.5rem;
                            }

                            .icon-container2:hover {
                                transform: scale(1.2);
                                background-color: #7b1fa2;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                    <span id="compositeline3"
                          class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                <div class="overflow-hidden card sales-card bg-secondary-gradient">
                    <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                        <div>
                            <h2 class="mb-3 text-white tx-12">{{ __('messages.pending_laboratory_tests') }}</h2>
                        </div>
                        <div class="pb-0 mt-0">
                            <div class="d-flex align-items-center">
                    <span class="icon-container4">
                        <i class="fa fa-2x fa-syringe"></i>
                    </span>
                                <div class="ml-3">
                                    <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                        {{ \App\Models\Laboratories\Laboratory::where('status', 0)->count() }} {{ __('messages.of_tests') }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <style>
                            .icon-container4 {
                                background-color: #e91e63; /* لون مختلف */
                                border-radius: 50%;
                                padding: 15px;
                                transition: transform 0.3s ease, background-color 0.3s ease;
                            }

                            .icon-effect4 {
                                color: #ffffff; /* لون الأيقونة */
                                font-size: 1.5rem;
                            }

                            .icon-container4:hover {
                                transform: scale(1.2);
                                background-color: #d81b60; /* لون جديد عند التحويم */
                                cursor: pointer;
                            }

                            .bg-primary-gradient {
                                background: linear-gradient(135deg, #ff9800, #ff5722); /* تدرج برتقالي */
                            }
                        </style>
                    </div>
                    <!-- إضافة عنصر السبان الذي يحتوي على بيانات الرسم البياني -->
                    <span id="compositeline4"
                          class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
                </div>
            </div>


        </div>

    @endif
    <!-- row closed -->
    @if(auth('staff')->user() && auth('staff')->user()->section->id==3)
        <div class="row row-sm">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-primary tabs-style-1">
                            <div class="tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li class="nav-item">
                                            <a href="#xray" class="nav-link active" data-toggle="tab">
                                                {{ __('messages.xray') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                <div class="tab-content">

                                    <!-- Tab for X-rays -->
                                    <div class="tab-pane active" id="xray">
                                        <div class="table-responsive">
                                            <table class="table table-hover text-md-nowrap text-center" id="example1">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('messages.patient_name') }}</th>
                                                    <th>{{ __('messages.service_or_offer') }}</th>
                                                    <th>{{ __('messages.description') }}</th>
                                                    <th>{{ __('messages.image') }}</th>
                                                    <th>{{ __('messages.action') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(\App\Models\Rays\Ray::latest()->take(5)->get() as $patientRay)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $patientRay->patient->name }}</td>
                                                        <td>
                                                            @if(isset($patientRay->invoice->service))
                                                                {{ $patientRay->invoice->service->name }}
                                                            @elseif(isset($patientRay->invoice->group))
                                                                {{ $patientRay->invoice->group->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $patientRay->description }}</td>

                                                        <!-- Display associated images -->
                                                        <td>
                                                            @if($patientRay->images->count() > 0)
                                                                @foreach($patientRay->images as $image)
                                                                    @if($image->type == 0)
                                                                        <img
                                                                            src="{{ asset('Dashboard/img/x-rays/'.$patientRay->patient->name.'/send/'.$patientRay->id.'/'.$image->filename) }}"
                                                                            style="width: 150px; border-radius: 10%; height: 80px; margin-right: 10px;">
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <span>{{ __('messages.no_images') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($patientRay->status == 1)
                                                                <strong>{{ $patientRay->staff_date }}</strong>
                                                            @else
                                                                <strong>{{ __('messages.not_done_yet') }}</strong>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <br>
                                                    @include('Dashboard.Doctors.DoctorDashboard.Invoices.delete')
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- Table content for X-rays -->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @elseif(auth('staff')->user() && auth('staff')->user()->section->id==2)
        <div class="row row-sm">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-primary tabs-style-1">
                            <div class="tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li class="nav-item">
                                            <a href="#lab" class="nav-link active"
                                               data-toggle="tab">{{ __('messages.laboratory_tests') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                <div class="tab-content">
                                    <!-- تبويب التحاليل -->
                                    <div class="tab-pane active" id="lab">
                                        <div class="table-responsive">
                                            <table class="table table-hover text-md-nowrap text-center" id="example1">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ __('messages.patient_name') }}</th>
                                                    <th>{{ __('messages.service_or_offer') }}</th>
                                                    <th>{{ __('messages.description') }}</th>
                                                    <th>{{ __('messages.image') }}</th>
                                                    <th>{{ __('messages.action') }}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(\App\Models\Laboratories\Laboratory::latest()->take(5)->get() as $patientRay)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $patientRay->patient->name }}</td>
                                                        <td>
                                                            @if(isset($patientRay->invoice->service))
                                                                {{ $patientRay->invoice->service->name }}
                                                            @elseif(isset($patientRay->invoice->group))
                                                                {{ $patientRay->invoice->group->name }}
                                                            @endif
                                                        </td>
                                                        <td>{{ $patientRay->description }}</td>
                                                        <td>
                                                            @if($patientRay->images->count() > 0)
                                                                @foreach($patientRay->images as $image)
                                                                    @if($image->type == 0)
                                                                        <img
                                                                            src="{{ asset('Dashboard/img/Laboratory/Send/'.$patientRay->patient->name.'/'.$patientRay->id.'/'.$image->filename) }}"
                                                                            style="width: 150px; border-radius: 10%; height: 80px; margin-right: 10px;">
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <span>{{ __('messages.no_images') }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($patientRay->status == 1)
                                                                <strong>{{ $patientRay->staff_date }}</strong>
                                                            @else
                                                                <strong>{{ __('messages.no_action_yet') }}</strong>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <br>
                                                    @include('Dashboard.Doctors.DoctorDashboard.Invoices.delete')
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div> <!-- محتويات الجدول للأشعة -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endif
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <!-- العنوان والوصف -->
                <div class="bg-transparent card-header pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0 card-title">{{ __('messages.order_status') }}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="mb-0 tx-12 text-muted">{{ __('messages.order_status_description') }}</p>
                </div>

                <!-- محتوى البطاقة -->
                <div class="card-body">
                    <!-- إحصائيات الحالة -->
                    <div class="total-revenue">
                        <div>
                            <h4>120,750</h4>
                            <label><span class="bg-primary"></span>{{ __('messages.success') }}</label>
                        </div>
                        <div>
                            <h4>56,108</h4>
                            <label><span class="bg-danger"></span>{{ __('messages.pending') }}</label>
                        </div>
                        <div>
                            <h4>32,895</h4>
                            <label><span class="bg-warning"></span>{{ __('messages.failed') }}</label>
                        </div>
                    </div>

                    <!-- الرسم البياني -->
                    <div id="bar" class="mt-4 sales-bar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->

    <!-- row opened -->


    <!-- row opened -->
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="pb-2 card card-dashboard-eight">
                <!-- عنوان البطاقة -->
                <h6 class="card-title">{{ __('messages.top_medical_countries') }}</h6>
                <span class="d-block mg-b-10 text-muted tx-12">
                {{ __('messages.medical_advancements_and_salaries') }}
            </span>

                <!-- قائمة الدول -->
                <div class="list-group">
                    <!-- الولايات المتحدة -->
                    <div class="list-group-item border-top-0">
                        <i class="flag-icon flag-icon-us flag-icon-squared"></i>
                        <p>{{ __('messages.united_states') }}</p>
                        <span>$230,000</span>
                    </div>

                    <!-- ألمانيا -->
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-de flag-icon-squared"></i>
                        <p>{{ __('messages.germany') }}</p>
                        <span>$185,000</span>
                    </div>

                    <!-- المملكة المتحدة -->
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-gb flag-icon-squared"></i>
                        <p>{{ __('messages.united_kingdom') }}</p>
                        <span>$120,000</span>
                    </div>

                    <!-- سويسرا -->
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-ch flag-icon-squared"></i>
                        <p>{{ __('messages.switzerland') }}</p>
                        <span>$200,000</span>
                    </div>

                    <!-- هولندا -->
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-nl flag-icon-squared"></i>
                        <p>{{ __('messages.netherlands') }}</p>
                        <span>$135,000</span>
                    </div>

                    <!-- أستراليا -->
                    <div class="mb-0 list-group-item border-bottom-0">
                        <i class="flag-icon flag-icon-au flag-icon-squared"></i>
                        <p>{{ __('messages.australia') }}</p>
                        <span>$150,000</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /row -->
    </div>
    <!-- /row -->
    </div>
    </div>
    <!-- Container closed -->
@endsection
@section('js')
    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('Dashboard/plugins/chart.js/Chart.bundle.min.js')}}"></script>
    <!-- Moment js -->
    <script src="{{URL::asset('Dashboard/plugins/raphael/raphael.min.js')}}"></script>
    <!--Internal  Flot js-->
    <script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/dashboard.sampledata.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/chart.flot.sampledata.js')}}"></script>
    <!--Internal Apexchart js-->
    <script src="{{URL::asset('Dashboard/js/apexcharts.js')}}"></script>
    <!-- Internal Map -->
    <script src="{{URL::asset('Dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/modal-popup.js')}}"></script>
    <!--Internal  index js -->
    <script src="{{URL::asset('Dashboard/js/index.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/jquery.vmap.sampledata.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#compositeline4').sparkline([5, 10, 5, 20, 22, 12, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 16, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44ad'
            });
        });

        $(document).ready(function () {
            $('#compositeline3').sparkline([5, 10, 5, 20, 22, 12, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 16, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });

        });

        $(document).ready(function () {
            $('#compositeline22').sparkline([5, 10, 5, 20, 22, 12, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 16, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#7BB661',
            });
        });

        $(document).ready(function () {
            $('#compositeline1').sparkline([5, 10, 5, 20, 22, 12, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 16, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });
        });

        $(document).ready(function () {
            $('#compositeline5').sparkline([5, 10, 5, 20, 22, 12, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 16, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });
        });

        $(document).ready(function () {
            $('#compositeline6').sparkline([5, 10, 5, 20, 20, 18, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 18, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#FFA500',
            });
        });

        $(document).ready(function () {
            $('#compositeline7').sparkline([5, 10, 5, 20, 20, 18, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 18, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#7BB661',
            });
        });

        $(document).ready(function () {
            $('#compositeline8').sparkline([5, 10, 5, 20, 20, 18, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 18, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });
        });

        $(document).ready(function () {
            $('#compositeline9').sparkline([5, 10, 5, 20, 20, 18, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 18, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });
        });

    </script>
@endsection

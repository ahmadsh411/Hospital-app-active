@extends('Dashboard.layouts.Doctor.master_doctor')
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
            <p class="text-muted mb-0">Welcome Dr. {{ auth('doctor')->user()->name }}!</p>
        </div>
        <div class="main-dashboard-header-center text-center">


            <!-- Font Awesome Icon for Admin -->
            <i class="fas fa-stethoscope fa-5x animated-icon"></i>

        </div>

        <!-- إضافة CSS للتغيير اللوني -->
        <style>
            @keyframes colorChange {
                0% { color: #ff7e5f; }
                25% { color: #feb47b; }
                50% { color: #00c6ff; }
                75% { color: #0072ff; }
                100% { color: #ff7e5f; }
            }

            .animated-icon {
                animation: colorChange 4s infinite; /* يتغير اللون كل ثانيتين */
            }
        </style>

        <!-- تأكد من تضمين Font Awesome في الصفحة -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


        <div class="main-dashboard-header-right">
            <div class="card card-body p-3 shadow-sm">
                <label class="tx-13 mb-2 font-weight-bold">Customer Ratings</label>
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
                    <span class="text-muted ms-2">(14,873)</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-primary-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">{{__('messages.Section')}} </h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container">
                        <i class="fa fa-folder icon-effect"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold"
                                    {{$doctor= \App\Models\Doctors\Doctor::where('id',auth('doctor')->user()->id)
                                      ->first()
                                       }}
                                >

                                       {{$doctor->section->name}}
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
                <span id="compositeline1" class="pt-1" >5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-success-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">{{ __('messages.Patients Under Review') }}</h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container1">
                        <i class= " fa fa-user-injured icon-effect1"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;"

                                >
                                    {{ $doctor->allinvoices->where('invoice_status', 0)->count()  }}:<span>{{ __('messages.Patients') }}</span>
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
                <span id="compositeline22" class="pt-1" >5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-purple-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">{{ __('messages.Patients Whose Reviews Are Finished') }}</h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container2">
                        <i class="fa fa-user-injured icon-effect2"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                     {{ $doctor->allinvoices->where('invoice_status',1)->count()  }}:<span>{{ __('messages.Patients') }}</span>
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
                <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-secondary-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">{{ __('messages.Patients Given Additional Reviews') }}</h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container4">
                        <i class="fa fa-user-injured fa-2x"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    {{ $doctor->allinvoices->where('invoice_status',2)->count()  }}:<span>{{ __('messages.Patients') }}</span>
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
                <span id="compositeline4" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>

{{--        --}}


        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-warning-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">{{ __('messages.Single Services') }}</h2>

                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container44">
                        <i class="fa  fa-2x fa-server"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                     {{ $doctor->allInvoices->where('invoice_type',0)->count() }}:<span>{{ __('messages.Of Services') }}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <style>
                        .icon-container44 {
                            background-color: orange;
                            border-radius: 50%;
                            padding: 15px;
                            transition: transform 0.3s ease, background-color 0.3s ease;
                        }
                        .icon-effect4 {
                            color: #ffffff;
                            font-size: 1.5rem;
                        }
                        .icon-container44:hover {
                            transform: scale(1.2);
                            background-color: yellow;
                            cursor: pointer;
                        }
                    </style>
                </div>
                <!-- إضافة عنصر السبان الذي يحتوي على بيانات الرسم البياني -->
                <span id="compositeline6" class="pt-1" >5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-primary-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">{{ __('messages.Offers') }}</h2>                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container4">
                      <i class="fas fa-users-cog icon-effect4"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    {{ $doctor->allinvoices->where('invoice_type', 1)->count() }}:<span>{{ __('messages.of services') }}</span>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <style>
                        .icon-container4 {
                            background-color: #d5d4e0;
                            border-radius: 50%;
                            padding: 15px;
                            transition: transform 0.3s ease, background-color 0.3s ease;
                        }
                        .icon-effect4 {
                            color: #ffffff;
                            font-size: 1.5rem;
                        }
                        .icon-container4:hover {
                            transform: scale(1.2);
                            background-color: #2980b9;
                            cursor: pointer;
                        }
                    </style>
                </div>
                <!-- إضافة عنصر السبان الذي يحتوي على بيانات الرسم البياني -->
                <span id="compositeline7" class="pt-1" >5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-success-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">{{ __('messages.Received Amounts') }}</h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container66">
                        <i class="fa fa-dollar icon-effect66"></i>
                    </span>
                            <div class="ml-3">

                                @php

                                    // الحصول على الفواتير من النوع المطلوب
                                    $doctor = auth('doctor')->user();
                                      $funds = $doctor->allinvoices;
                                      $tot_with_tax = 0;
                                      $tax_values = 0;
                                      $tot_with_tax_credit = 0;
                                      $tax_values_credit = 0;

                                        foreach ($funds as $fund) {

                                        if ($fund->type==1){
                                            $tot_with_tax += $fund->tot_with_tax;
                                            $tax_values += $fund->tax_value;
                                        }elseif($fund->type==0){
                                            $tot_with_tax_credit+=$fund->tot_with_tax;
                                            $tax_values_credit+=$fund->tax_value;
                                        }

                                        }
                                    // حساب النتيجة النهائية بعد طرح الضرائب
                                        $x = $tot_with_tax - $tax_values;
                                        $y=$tot_with_tax_credit - $tax_values_credit;
                                @endphp
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                  {{$x}}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <style>
                        .icon-container66 {
                            background-color: #1EC71E;
                            border-radius: 50%;
                            padding: 15px;
                            transition: transform 0.3s ease, background-color 0.3s ease;
                        }
                        .icon-effect66 {
                            color: #ffffff;
                            font-size: 1.5rem;
                        }
                        .icon-container66:hover {
                            transform: scale(1.2);
                            background-color: #4dc0b5;
                            cursor: pointer;
                        }
                    </style>
                </div>
                <!-- إضافة عنصر السبان الذي يحتوي على بيانات الرسم البياني -->
                <span id="compositeline8" class="pt-1" >5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>


        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-primary-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">{{ __('messages.Unreceived Amounts') }}</h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container4">
                        <i class="fa fa-2x fa-dollar-sign icon-effect4"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                     {{$y }}
                                </h4>
                            </div>
                        </div>
                    </div>
                    <style>
                        .icon-container4 {
                            background-color: #3498db;
                            border-radius: 50%;
                            padding: 15px;
                            transition: transform 0.3s ease, background-color 0.3s ease;
                        }
                        .icon-effect4 {
                            color: #ffffff;
                            font-size: 1.5rem;
                        }
                        .icon-container4:hover {
                            transform: scale(1.2);
                            background-color: #2980b9;
                            cursor: pointer;
                        }
                    </style>
                </div>
                <!-- إضافة عنصر السبان الذي يحتوي على بيانات الرسم البياني -->
                <span id="compositeline9" class="pt-1" >5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>


    </div>
    <!-- row closed -->

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header bg-transparent pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-0">{{ __('messages.Order Status') }}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 text-muted mb-0">{{ __('messages.Order Status Description') }}</p>
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                            <h4>120,750</h4>
                            <label><span class="bg-primary"></span>{{ __('messages.Success') }}</label>
                        </div>
                        <div>
                            <h4>56,108</h4>
                            <label><span class="bg-danger"></span>{{ __('messages.Pending') }}</label>
                        </div>
                        <div>
                            <h4>32,895</h4>
                            <label><span class="bg-warning"></span>{{ __('messages.Failed') }}</label>
                        </div>
                    </div>
                    <div id="bar" class="sales-bar mt-4"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel panel-primary tabs-style-1">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line">
                                    <li class="nav-item"><a href="#patientInfo" class="nav-link active" data-toggle="tab">{{ __('messages.Patient Information') }}</a></li>
                                    <li class="nav-item"><a href="#xray" class="nav-link" data-toggle="tab">{{ __('messages.X-ray') }}</a></li>
                                    <li class="nav-item"><a href="#laboratory" class="nav-link" data-toggle="tab">{{ __('messages.Laboratory') }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                            <div class="tab-content">

                                <!-- Patient Information Tab -->
                                <div class="tab-pane active" id="patientInfo">
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table table-hover text-center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.Patient Name') }}</th>
                                                <th>{{ __('messages.Phone Number') }}</th>
                                                <th>{{ __('messages.Email Address') }}</th>
                                                <th>{{ __('messages.Date of Birth') }}</th>
                                                <th>{{ __('messages.Gender') }}</th>
                                                <th>{{ __('messages.Blood Type') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Models\Invoices\OneTable\Invoice::where('doctor_id',auth('doctor')->user()->id)->latest()->take(5)->get()->unique('patient_id') as $invoice)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{ $invoice->patient->name }}</td>
                                                    <td>{{ $invoice->patient->phone }}</td>
                                                    <td>{{ $invoice->patient->email }}</td>
                                                    <td>{{ $invoice->patient->date_of_birth }}</td>
                                                    <td>{{ $invoice->patient->gender_id == 1 ? __('messages.Male') : __('messages.Female') }}</td>
                                                    <td>{{ $invoice->patient->bloodtype->type }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- X-ray Tab -->
                                <div class="tab-pane" id="xray">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center"
                                               id="example1">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.Patient Name') }}</th>
                                                <th>{{ __('messages.Service or Offer Name') }}</th>
                                                <th>{{ __('messages.Description') }}</th>
                                                <th>{{ __('messages.Image') }}</th>
                                                <th>{{ __('messages.Status') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Models\Rays\Ray::where('doctor_id',auth('doctor')->user()->id)->latest()->take(5)->get() as $patientRay)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$patientRay->patient->name}}</td>
                                                    <td>
                                                        @if(isset($patientRay->invoice->service))
                                                            {{$patientRay->invoice->service->name}}
                                                        @elseif(isset($patientRay->invoice->group))
                                                            {{$patientRay->invoice->group->name}}
                                                        @endif
                                                    </td>
                                                    <td>{{$patientRay->description}}</td>
                                                    <td>
                                                        @if($patientRay->images->count() > 0 )
                                                            @foreach($patientRay->images as $image)
                                                                @if($image->type==0)
                                                                    <img src="{{ asset('Dashboard/img/x-rays/'.$patientRay->patient->name.'/send/'.$patientRay->id.'/'.$image->filename) }}"
                                                                         style="width: 150px; border-radius: 10%; height: 80px; margin-right: 10px;">
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            <span>{{ __('messages.No Images Available') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($patientRay->status==0)
                                                            <strong>{{ __('messages.Completed') }}</strong>
                                                        @else
                                                            <strong>{{ __('messages.Not Completed') }}</strong>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <br>
                                                @include('Dashboard.Doctors.DoctorDashboard.Invoices.delete')
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Laboratory Tab -->
                                <div class="tab-pane" id="laboratory">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center"
                                               id="example1">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('messages.Patient Name') }}</th>
                                                <th>{{ __('messages.Service or Offer Name') }}</th>
                                                <th>{{ __('messages.Description') }}</th>
                                                <th>{{ __('messages.Image') }}</th>
                                                <th>{{ __('messages.Status') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Models\Laboratories\Laboratory::where('doctor_id',auth('doctor')->user()->id)->latest()->take(5)->get() as $patientLaboratory)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$patientLaboratory->patient->name}}</td>
                                                    <td>
                                                        @if(isset($patientLaboratory->invoice->service))
                                                            {{$patientLaboratory->invoice->service->name}}
                                                        @elseif(isset($patientLaboratory->invoice->group))
                                                            {{$patientLaboratory->invoice->group->name}}
                                                        @endif
                                                    </td>
                                                    <td>{{$patientLaboratory->description}}</td>
                                                    <td>
                                                        @if($patientLaboratory->image)
                                                            <img src="{{ asset('Dashboard/img/Laboratory/'.$patientLaboratory->patient->name.'/'.$patientLaboratory->id.'/'.$image->filename) }}"
                                                                 style="width: 150px; border-radius: 10%; height: 80px; margin-right: 10px;">
                                                        @else
                                                            <span>{{ __('messages.No Images Available') }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($patientLaboratory->status==1)
                                                            <strong>{{ __('messages.Completed') }}</strong>
                                                        @else
                                                            <strong>{{ __('messages.Not Completed') }}</strong>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @include('Dashboard.Doctors.DoctorDashboard.Invoices.Laboratory.delete')
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->


    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="pb-2 card card-dashboard-eight">
                <h6 class="card-title">{{ __('messages.Top Medical Advanced Countries') }}</h6>
                <span class="d-block mg-b-10 text-muted tx-12">{{ __('messages.Medical advancements and average doctor salary by country') }}</span>
                <div class="list-group">
                    <!-- Add items here for each country -->
                    <div class="list-group-item border-top-0">
                        <i class="flag-icon flag-icon-us flag-icon-squared"></i>
                        <p>{{ __('messages.United States') }}</p><span>{{ __('messages.USD_230K') }}</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-de flag-icon-squared"></i>
                        <p>{{ __('messages.Germany') }}</p><span>{{ __('messages.USD_185K') }}</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-gb flag-icon-squared"></i>
                        <p>{{ __('messages.United Kingdom') }}</p><span>{{ __('messages.USD_120K') }}</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-ch flag-icon-squared"></i>
                        <p>{{ __('messages.Switzerland') }}</p><span>{{ __('messages.USD_200K') }}</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-nl flag-icon-squared"></i>
                        <p>{{ __('messages.Netherlands') }}</p><span>{{ __('messages.USD_135K') }}</span>
                    </div>
                    <div class="mb-0 list-group-item border-bottom-0">
                        <i class="flag-icon flag-icon-au flag-icon-squared"></i>
                        <p>{{ __('messages.Australia') }}</p><span>{{ __('messages.USD_150K') }}</span>
                    </div>
                </div>
            </div>
        </div>
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
        $(document).ready(function() {
            $('#compositeline4').sparkline([5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44ad'
            });
        });

        $(document).ready(function() {
            $('#compositeline3').sparkline([5, 10, 5, 20, 22, 12, 15, 18, 20, 15, 8, 12, 22, 5, 10, 12, 22, 15, 16, 10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });

        });

        $(document).ready(function() {
            $('#compositeline22').sparkline([5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#7BB661',
            });
        });

        $(document).ready(function() {
            $('#compositeline1').sparkline([5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });
        });

        $(document).ready(function() {
            $('#compositeline5').sparkline([5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });
        });

        $(document).ready(function() {
            $('#compositeline6').sparkline([5,10,5,20,20,18,15,18,20,15,8,12,22,5,10,12,22,15,18,10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#FFA500',
            });
        });

        $(document).ready(function() {
            $('#compositeline7').sparkline([5,10,5,20,20,18,15,18,20,15,8,12,22,5,10,12,22,15,18,10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#7BB661',
            });
        });

        $(document).ready(function() {
            $('#compositeline8').sparkline([5,10,5,20,20,18,15,18,20,15,8,12,22,5,10,12,22,15,18,10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });
        });

        $(document).ready(function() {
            $('#compositeline9').sparkline([5,10,5,20,20,18,15,18,20,15,8,12,22,5,10,12,22,15,18,10], {
                type: 'line',
                width: '100%',
                height: '50',
                lineColor: '#ffffff',
                fillColor: '#8e44aa',
            });
        });

    </script>

@endsection

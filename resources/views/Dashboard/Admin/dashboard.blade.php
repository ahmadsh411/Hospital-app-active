@extends('Dashboard.layouts.Admin.master')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{URL::asset('Dashboard/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet"/>
    <!-- Maps css -->
    <link href="{{URL::asset('Dashboard/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between align-items-center mb-4">
        <div class="left-content">
            <h2 class="main-content-title tx-24 mb-1">{{ __('breadcrumb.greeting') }}</h2>
            <p class="text-muted mb-0">{{ __('breadcrumb.welcome_message', ['name' => auth('admin')->user()->name]) }}</p>
        </div>

        <div class="main-dashboard-header-center text-center">


            <!-- Font Awesome Icon for Admin -->
            <i class="fas fa-user-shield fa-5x animated-icon"></i>
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
                <label class="tx-13 mb-2 font-weight-bold">{{ __('breadcrumb.customer_ratings') }}</label>
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
                        <h2 class="mb-3 text-white tx-12"></h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container">
                        <i class="fa fa-folder icon-effect"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    <span>{{ __('dashboard.sections') }}:</span> {{ \App\Models\Sections\Section::all()->count() }}
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
                        <h2 class="mb-3 text-white tx-12"></h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container1">
                        <i class="fa fa-user-md icon-effect1"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                    <span>{{ __('dashboard.doctors') }}:</span> {{ \App\Models\Doctors\Doctor::all()->count() }}
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
                        <h2 class="mb-3 text-white tx-12"></h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container2">
                        <i class="fa fa-user-injured icon-effect2"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                    <span>{{ __('dashboard.patients') }}:</span> {{ \App\Models\Patients\Patient::all()->count() }}                                 </h4>
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
                        <h2 class="mb-3 text-white tx-12"></h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container4">
                        <i class="fa fa-2x fa-syringe"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    <span>{{ __('dashboard.services') }}:</span> {{ \App\Models\Service\SingleService::all()->count() + \App\Models\Service\MultiService::all()->count() }}
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

        <!-- ديف لخدمة الـ Multi Service -->
        <!-- ديف لخدمة الـ Multi Service -->

        <!-- ديف لشركات التأمين -->
        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-warning-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12"></h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container44">
                        <i class="fa  fa-2x fa-user-tie"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    <span>{{ __('dashboard.employees') }}:</span> {{ \App\Models\Staffs\Staff::all()->count() }}
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
                        <h2 class="mb-3 text-white tx-12"></h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container4">
                        <i class=" fas fa-user-shield icon-effect4"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    <span>{{ __('dashboard.insurance') }}:</span> {{ \App\Models\Insurances\Insurance::all()->count() }}
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
                        <h2 class="mb-3 text-white tx-12"></h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container66">
                        <i class="fa fa-ambulance icon-effect66"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    <span>{{ __('dashboard.ambulance') }}:</span> {{ \App\Models\Ambulances\Ambulance::all()->count() }}
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
                        <h2 class="mb-3 text-white tx-12"></h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container4">
                        <i class="fa fa-2x fa-dollar-sign icon-effect4"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    <span>{{ __('dashboard.invoices') }}:</span> {{ \App\Models\Invoices\OneTable\Invoice::all()->count() }}
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
                <div class="bg-transparent card-header pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0 card-title">{{ __('fund_schedule.title') }}</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="mb-0 tx-12 text-muted">{{ __('fund_schedule.description') }}</p>
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                            <h4>{{ \App\Models\Boxes\Fund_Schedule::all()->sum('credit') }}$</h4>
                            <label><span class="bg-primary"></span>{{ __('fund_schedule.credits') }}</label>
                        </div>
                        <div>
                            <h4>{{ \App\Models\Boxes\Fund_Schedule::all()->sum('debit') }}$</h4>
                            <label><span class="bg-danger"></span>{{ __('fund_schedule.debits') }}</label>
                        </div>
                        <div>
                            <h4>{{ \App\Models\Boxes\PatientAccount::all()->sum('debit') }}$</h4>
                            <label><span class="bg-warning"></span>{{ __('fund_schedule.pending') }}</label>
                        </div>
                    </div>
                    <div id="bar" class="mt-4 sales-bar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- row closed -->

    <!-- row opened -->
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
                                        <a href="#patientInfo" class="nav-link active" data-toggle="tab">{{ __('tabs.patient_info') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#invoices" class="nav-link" data-toggle="tab">{{ __('tabs.invoices') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#payments" class="nav-link" data-toggle="tab">{{ __('tabs.payments') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#accountStatement" class="nav-link" data-toggle="tab">{{ __('tabs.account_statement') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#xray" class="nav-link" data-toggle="tab">{{ __('tabs.xray') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#laboratory" class="nav-link" data-toggle="tab">{{ __('tabs.laboratory') }}</a>
                                    </li>
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
                                                <th>{{ __('tabs.patient_name') }}</th>
                                                <th>{{ __('tabs.phone') }}</th>
                                                <th>{{ __('tabs.email') }}</th>
                                                <th>{{ __('tabs.date_of_birth') }}</th>
                                                <th>{{ __('tabs.gender') }}</th>
                                                <th>{{ __('tabs.blood_type') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Models\Patients\Patient::latest()->take(5)->get() as $patient)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $patient->name }}</td>
                                                    <td>{{ $patient->phone }}</td>
                                                    <td>{{ $patient->email }}</td>
                                                    <td>{{ $patient->date_of_birth }}</td>
                                                    <td>{{ $patient->gender_id == 1 ? __('tabs.male') : __('tabs.female') }}</td>
                                                    <td>{{ $patient->bloodtype->type }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Invoices Tab -->
                                <div class="tab-pane" id="invoices">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('tabs.service_name') }}</th>
                                                <th>{{ __('tabs.invoice_date') }}</th>
                                                <th>{{ __('tabs.total_with_tax') }}</th>
                                                <th>{{ __('tabs.invoice_type') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Models\Invoices\OneTable\Invoice::latest()->take(5)->get() as $invoice)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $invoice->service ? $invoice->service->name : $invoice->group->name }}</td>
                                                    <td>{{ $invoice->invoice_date }}</td>
                                                    <td>{{ $invoice->tot_with_tax }}</td>
                                                    <td>{{ $invoice->type == 1 ? __('tabs.cash') : __('tabs.credit') }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="4" class="alert alert-success">{{ __('tabs.total') }}</th>
                                                <td class="alert alert-primary">{{ number_format(\App\Models\Invoices\OneTable\Invoice::all()->sum('tot_with_tax'), 2) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Payments Tab -->
                                <div class="tab-pane" id="payments">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('tabs.payment_date') }}</th>
                                                <th>{{ __('tabs.patient_name') }}</th>
                                                <th>{{ __('tabs.amount') }}</th>
                                                <th>{{ __('tabs.description') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Models\Boxes\Receipt::latest()->take(5)->get() as $receipt)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $receipt->date }}</td>
                                                    <td>{{ $receipt->patient->name }}</td>
                                                    <td>{{ $receipt->debit }}</td>
                                                    <td>{{ $receipt->description }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <th colspan="4" class="alert alert-success">{{ __('tabs.total') }}</th>
                                                <td class="alert alert-primary">{{ number_format(\App\Models\Boxes\Receipt::sum('debit'), 2) }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Account Statement Tab -->
                                <div class="tab-pane" id="accountStatement">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>{{ __('tabs.entry_date') }}</th>
                                                <th>{{ __('tabs.patient_name') }}</th>
                                                <th>{{ __('tabs.description') }}</th>
                                                <th>{{ __('tabs.debit') }}</th>
                                                <th>{{ __('tabs.credit') }}</th>
                                                <th>{{ __('tabs.final_balance') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Models\Boxes\PatientAccount::latest()->take(5)->get() as $account)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $account->date }}</td>
                                                    <td>{{ $account->patient->name }}</td>
                                                    <td>{{ $account->description }}</td>
                                                    <td>{{ $account->debit }}</td>
                                                    <td>{{ $account->credit }}</td>
                                                    <td>{{ $account->debit - $account->credit }}</td>
                                                </tr>
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
    </div>
    <!-- row close -->

    <!-- row opened -->
    <div class="row row-sm row-deck">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="pb-2 card card-dashboard-eight">
                <h6 class="card-title">{{ __('dashboard.top_medical_countries') }}</h6>
                <span class="d-block mg-b-10 text-muted tx-12">{{ __('dashboard.medical_advancements') }}</span>
                <div class="list-group">
                    <!-- عناصر الدول مع الرواتب -->
                    <div class="list-group-item border-top-0">
                        <i class="flag-icon flag-icon-us flag-icon-squared"></i>
                        <p>{{ __('dashboard.countries.united_states') }}</p><span>$230,000</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-de flag-icon-squared"></i>
                        <p>{{ __('dashboard.countries.germany') }}</p><span>$185,000</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-gb flag-icon-squared"></i>
                        <p>{{ __('dashboard.countries.united_kingdom') }}</p><span>$120,000</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-ch flag-icon-squared"></i>
                        <p>{{ __('dashboard.countries.switzerland') }}</p><span>$200,000</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-nl flag-icon-squared"></i>
                        <p>{{ __('dashboard.countries.netherlands') }}</p><span>$135,000</span>
                    </div>
                    <div class="mb-0 list-group-item border-bottom-0">
                        <i class="flag-icon flag-icon-au flag-icon-squared"></i>
                        <p>{{ __('dashboard.countries.australia') }}</p><span>$150,000</span>
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

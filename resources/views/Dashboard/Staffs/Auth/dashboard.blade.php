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
            <p class="text-muted mb-0">مرحبا {{ auth('staff')->user()->name }}!</p>
        </div>
        <div class="main-dashboard-header-center text-center">


            <!-- Font Awesome Icon for Admin -->
            <i class="fas fa-user fa-5x animated-icon"></i>
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
                        <h2 class="mb-3 text-white tx-12">القسم </h2>
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
                <span id="compositeline1" class="pt-1" >5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
            <div class="overflow-hidden card sales-card bg-success-gradient">
                <div class="pt-0 pt-3 pb-2 pl-3 pr-3">
                    <div class="">
                        <h2 class="mb-3 text-white tx-12">الفحص الشعاعي الذي تم </h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container1">
                      <i class="fas fa-radiation icon-effect1"></i>

                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                     {{
                                        \App\Models\Rays\Ray::wherenotNull('staff_id')->where('status',1)->count()
                                             }}:من الاشعة
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
                        <h2 class="mb-3 text-white tx-12">التحويلات للاشعة</h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container2">
                         <i class="fas fa-radiation icon-effect2"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold" style="margin-left: 15px;">
                                    {{
                                       \App\Models\Rays\Ray::all()->count()
                                            }}:من التحويلات للاشعة
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
                        <h2 class="mb-3 text-white tx-12">الاشعة الواجب اجراؤها </h2>
                    </div>
                    <div class="pb-0 mt-0">
                        <div class="d-flex align-items-center">
                    <span class="icon-container4">
                        <i class="fa fa-2x fa-syringe"></i>
                    </span>
                            <div class="ml-3">
                                <h4 class="mb-1 text-white tx-20 font-weight-bold">
                                    {{\App\Models\Rays\Ray::where('status',0)->count()}}:من الاشعة
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

    </div>
    <!-- row closed -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="panel panel-primary tabs-style-1">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line">

                                    <li class="nav-item"><a href="#xray" class="nav-link active" data-toggle="tab">الاشعه</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                            <div class="tab-content">

                                <!-- Patient Information Tab -->

                                <!-- Invoices Tab -->

                                <div class="tab-pane active" id="xray">
                                    <div class="table-responsive">
                                        <table class="table table-hover text-md-nowrap text-center"
                                               id="example1">
                                            <thead>
                                            <tr>
                                                <th>#</th>

                                                <th>اسم المريض</th>
                                                <th>اسم الخدمة او العرض</th>
                                                <th>الوصف</th>
                                                <th>الصورة</th>
                                                <th>الاجراء</th>



                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Models\Rays\Ray::latest()->take(5)->get() as $patientRay)
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

                                                    <!-- عرض جميع الصور المرتبطة بالشعاع -->
                                                    <td>
                                                        @if($patientRay->images->count() > 0 )
                                                            @foreach($patientRay->images as $image)
                                                                @if($image->type==0)
                                                                    <img src="{{ asset('Dashboard/img/x-rays/'.$patientRay->patient->name.'/send/'.$patientRay->id.'/'.$image->filename) }}"
                                                                         style="width: 150px; border-radius: 10%; height: 80px; margin-right: 10px;">
                                                                @endif
                                                            @endforeach

                                                        @else
                                                            <span>لا توجد صور</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($patientRay->status==1)
                                                            <strong > {{$patientRay->staff_date}} </strong>
                                                        @else
                                                            <strong>لم يتم الاجراء بعد</strong>
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
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="bg-transparent card-header pd-b-0 pd-t-20 bd-b-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="mb-0 card-title">Order status</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="mb-0 tx-12 text-muted">Order Status and Tracking. Track your order from ship date to
                        arrival. To begin, enter your order number.</p>
                </div>
                <div class="card-body">
                    <div class="total-revenue">
                        <div>
                            <h4>120,750</h4>
                            <label><span class="bg-primary"></span>success</label>
                        </div>
                        <div>
                            <h4>56,108</h4>
                            <label><span class="bg-danger"></span>Pending</label>
                        </div>
                        <div>
                            <h4>32,895</h4>
                            <label><span class="bg-warning"></span>Failed</label>
                        </div>
                    </div>
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
                <h6 class="card-title">Top Medical Advanced Countries</h6>
                <span class="d-block mg-b-10 text-muted tx-12">Medical advancements and average doctor salary by country</span>
                <div class="list-group">
                    <!-- Add items here for each country -->
                    <div class="list-group-item border-top-0">
                        <i class="flag-icon flag-icon-us flag-icon-squared"></i>
                        <p>United States</p><span>$230,000</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-de flag-icon-squared"></i>
                        <p>Germany</p><span>$185,000</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-gb flag-icon-squared"></i>
                        <p>United Kingdom</p><span>$120,000</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-ch flag-icon-squared"></i>
                        <p>Switzerland</p><span>$200,000</span>
                    </div>
                    <div class="list-group-item">
                        <i class="flag-icon flag-icon-nl flag-icon-squared"></i>
                        <p>Netherlands</p><span>$135,000</span>
                    </div>
                    <div class="mb-0 list-group-item border-bottom-0">
                        <i class="flag-icon flag-icon-au flag-icon-squared"></i>
                        <p>Australia</p><span>$150,000</span>
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

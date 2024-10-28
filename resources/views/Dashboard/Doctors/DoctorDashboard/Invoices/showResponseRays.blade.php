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
                <h4 class="content-title mb-0 my-auto">تفاصيل الإشعاع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الإشعاع #{{$ray->id}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">تفاصيل الإشعاع</h4>
            <div class="row">
                <!-- وصف الإشعاع -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الوصف:</label>
                        <p class="form-control">{{ $ray->description }}</p>
                    </div>
                </div>

                <!-- حالة الإشعاع -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الحالة:</label>
                        <p class="form-control">{{ $ray->status ? 'نشط' : 'غير نشط' }}</p>
                    </div>
                </div>

                <!-- المريض -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>المريض:</label>
                        <p class="form-control">{{ $ray->patient->name }}</p>
                    </div>
                </div>

                <!-- الطبيب -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>الطبيب:</label>
                        <p class="form-control">{{ $ray->doctor->name }}</p>
                    </div>
                </div>

                <!-- الفاتورة -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>رقم الفاتورة:</label>
                        <p class="form-control">{{ $ray->invoice->id }}</p>
                    </div>
                </div>

                <!-- الموظف -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>اسم الموظف:</label>
                        <p class="form-control">{{ $ray->staff_name }}</p>
                    </div>
                </div>

                <!-- وصف الموظف -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>وصف الموظف:</label>
                        <p class="form-control">{{ $ray->staff_description }}</p>
                    </div>
                </div>

                <!-- تاريخ الإشعاع -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>تاريخ الإشعاع:</label>
                        <p class="form-control">{{ $ray->staff_date }}</p>
                    </div>
                </div>

                <!-- الصور المرتبطة -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label>الصور المرسلة :</label>
                        <div class="d-flex flex-wrap">
                            @if($ray->images->count() > 0)
                                @foreach($ray->images as $image)
                                    @if($image->type==0)
                                    <img src="{{ asset('Dashboard/img/x-rays/'.$ray->patient->name.'/send/'.$ray->id.'/'.$image->filename) }}" class="img-thumbnail m-2" style="width: 150px; height: 150px;">
                                    @endif
                                @endforeach
                            @else
                                <p>لا توجد صور مرتبطة بهذا الإشعاع.</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>الصور الخاصة بالشعاع من المخبر :</label>
                        <div class="d-flex flex-wrap">

                                @foreach($ray->images as $image)
                                    @if($image->type==1)
                                    <img src="{{ asset('Dashboard/img/x-rays/'.$ray->patient->name.'/Ready/'.$ray->staff->name.'/'.$ray->id.'/'.$image->filename) }}"
                                         alt="صورة الإشعاع المرسلة من المخبر"
                                         class="img-thumbnail m-2"
                                         style="width: 150px; height: 150px;">
                                    @endif
                                @endforeach

                        </div>
                    </div>

                </div>

                <!-- زر الرجوع -->
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="{{ route('patient.details',$ray->invoice->id) }}" class="btn btn-secondary">الرجوع</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
@endsection

@extends('Dashboard.layouts.Doctor.master_doctor')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <style>
        /* التنسيق الأساسي للصورة */
        #imagePreviewContainer img {
            max-width: 150px;
            height: auto;
            border: 2px solid #ddd;
            padding: 5px;
            margin-top: 10px;
            border-radius: 8px;
            cursor: pointer; /* مؤشر لتوضيح أن الصورة قابلة للنقر */
        }

        /* تنسيق الصورة عند التكبير */
        .modal {
            display: none; /* مخفي افتراضيًا */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal img {
            max-width: 80%;
            max-height: 80%;
            border-radius: 12px;
        }

        /* تنسيق زر الإغلاق */
        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #fff;
            font-size: 30px;
            cursor: pointer;
        }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('messages.ray_details') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.ray_details') }} #{{ $ray->id }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('messages.ray_details') }}</h4>
            <div class="row">
                <!-- وصف الإشعاع -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('messages.description') }}:</label>
                        <p class="form-control">{{ $ray->description }}</p>
                    </div>
                </div>

                <!-- حالة الإشعاع -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('messages.status') }}:</label>
                        <p class="form-control">{{ $ray->status ? __('messages.active') : __('messages.inactive') }}</p>
                    </div>
                </div>

                <!-- المريض -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('messages.patient') }}:</label>
                        <p class="form-control">{{ $ray->patient->name }}</p>
                    </div>
                </div>

                <!-- الطبيب -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('messages.doctor') }}:</label>
                        <p class="form-control">{{ $ray->doctor->name }}</p>
                    </div>
                </div>

                <!-- الفاتورة -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('messages.invoice_number') }}:</label>
                        <p class="form-control">{{ $ray->invoice->id }}</p>
                    </div>
                </div>

                <!-- الموظف -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('messages.staff_name') }}:</label>
                        <p class="form-control">{{ $ray->staff_name }}</p>
                    </div>
                </div>

                <!-- وصف الموظف -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('messages.staff_description') }}:</label>
                        <p class="form-control">{{ $ray->staff_description }}</p>
                    </div>
                </div>

                <!-- تاريخ الإشعاع -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>{{ __('messages.ray_date') }}:</label>
                        <p class="form-control">{{ $ray->staff_date }}</p>
                    </div>
                </div>

                <!-- الصور المرتبطة -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{ __('messages.sent_images') }}:</label>
                        <div class="d-flex flex-wrap">
                            @if($ray->images->count() > 0)
                                @foreach($ray->images as $image)
                                    @if($image->type == 0)
                                        <img src="{{ asset('Dashboard/img/x-rays/'.$ray->patient->name.'/send/'.$ray->id.'/'.$image->filename) }}"
                                             class="img-thumbnail m-2"
                                             style="width: 150px; height: 150px;">
                                    @endif
                                @endforeach
                            @else
                                <p>{{ __('messages.no_images') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('messages.laboratory_images') }}:</label>
                        <div class="d-flex flex-wrap">
                            @foreach($ray->images as $image)
                                @if($image->type == 1)
                                    <img src="{{ asset('Dashboard/img/x-rays/'.$ray->patient->name.'/Ready/'.$ray->staff->name.'/'.$ray->id.'/'.$image->filename) }}"
                                         alt="{{ __('messages.lab_ray_image') }}"
                                         class="img-thumbnail m-2"
                                         style="width: 300px; height: 150px;"
                                         onclick="openModal('{{ asset('Dashboard/img/x-rays/'.$ray->patient->name.'/Ready/'.$ray->staff->name.'/'.$ray->id.'/'.$image->filename) }}')">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="imageModal" class="modal" onclick="closeModal()">
                    <span class="close-btn">&times;</span>
                    <img id="modalImage" src="" alt="{{ __('messages.enlarged_ray_image') }}">
                </div>

                <!-- زر الرجوع -->
                <div class="col-md-12">
                    <div class="form-group">
                        <a href="{{ route('patient.details', $ray->invoice->id) }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
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
    <script>
        // عرض الصورة في نافذة تكبير
        function openModal(imageSrc) {
            var modal = document.getElementById('imageModal');
            var modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
            modal.style.display = 'flex';
        }

        // إغلاق نافذة التكبير
        function closeModal() {
            var modal = document.getElementById('imageModal');
            modal.style.display = 'none';
        }
    </script>
@endsection

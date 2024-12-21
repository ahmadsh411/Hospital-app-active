@extends('Dashboard.layouts.Staff.master_staff')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('messages.view_ray_details') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $ray->description }}</span>
            </div>
        </div>
    </div>

    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- الفورم -->
            <form action="{{ route('staff.x-ray-update', ['id' => $ray->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST') <!-- تأكد أن الطريقة هي POST حسب المسار المحدد -->

                <!-- حقل الوصف -->
                <div class="form-group">
                    <label for="description">{{ __('messages.description') }}</label>
                    <input type="text" name="description" class="form-control" value="{{ $ray->description }}" readonly>
                </div>

                <!-- حقل المريض -->
                <div class="form-group">
                    <label for="patient_id">{{ __('messages.patient') }}</label>
                    <input type="text" name="patient" class="form-control" value="{{ $ray->patient->name }}" readonly>
                </div>

                <!-- حقل الطبيب -->
                <div class="form-group">
                    <label for="doctor_id">{{ __('messages.doctor') }}</label>
                    <input type="text" name="doctor" class="form-control" value="{{ $ray->doctor->name }}" readonly>
                </div>

                <!-- حقل وصف الموظف (staff_description) -->
                <div class="form-group">
                    <label for="staff_description">{{ __('messages.staff_description') }}</label>
                    <input type="text" name="staff_description" class="form-control">
                </div>

                <!-- حقل الصور -->
                <div class="form-group">
                    <label for="images">{{ __('messages.current_images') }}</label>
                    @if($ray->images->count() > 0)
                        <div class="d-flex">
                            @foreach($ray->images as $image)
                                <img src="{{ asset('Dashboard/img/x-rays/'.$ray->patient->name.'/send/'.$ray->id.'/'.$image->filename) }}" style="width: 100px; margin-right: 10px;">
                            @endforeach
                        </div>
                    @else
                        <p>{{ __('messages.no_current_images') }}</p>
                    @endif
                    <br>
                    <br>
                    <br>
                    <input type="hidden" value="1" name="type">

                    <div class="form-group">
                        <label for="image">
                            <i class="fas fa-upload"></i> {{ __('messages.upload_images') }}
                        </label>
                        <input type="file" class="form-control" id="image" name="image[]" accept="image/*" required onchange="previewImage(event)" multiple>
                    </div>
                </div>

                <!-- زر الرجوع -->
                <div class="form-group">
                    <a href="{{ route('staff.x-rays') }}" class="btn btn-secondary">{{ __('messages.back') }}</a>
                    <input type="submit" value="{{ __('messages.submit') }}" class="btn btn-primary" />
                </div>

                <div class="form-group text-center" id="imagePreviewContainer" style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
                    <!-- سيتم عرض الصور هنا -->
                </div>
            </form>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{URL::asset('Dashboard/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        // JavaScript لعرض معاينة كل الصور التي تم تحميلها
        function previewImage(event) {
            var imagePreviewContainer = document.getElementById('imagePreviewContainer');
            imagePreviewContainer.innerHTML = ""; // إفراغ الحاوية قبل عرض الصور الجديدة

            for (var i = 0; i < event.target.files.length; i++) {
                var reader = new FileReader();

                reader.onload = (function(fileIndex) {
                    return function(event) {
                        // إنشاء عنصر صورة جديد لكل ملف
                        var img = document.createElement('img');
                        img.src = event.target.result;
                        img.alt = 'معاينة الصورة';
                        img.style.maxWidth = '150px';
                        img.style.height = 'auto';
                        img.style.border = '2px solid #ddd';
                        img.style.padding = '5px';
                        img.style.marginTop = '10px';
                        img.style.borderRadius = '8px'; // زوايا دائرية لإضفاء جمالية

                        // إضافة الصورة إلى الحاوية
                        imagePreviewContainer.appendChild(img);
                    };
                })(i);

                reader.readAsDataURL(event.target.files[i]);
            }
        }
    </script>
@endsection

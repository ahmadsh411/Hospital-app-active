@extends('Dashboard.layouts.Staff.master_staff')

@section('css')
    <link href="{{ URL::asset('Dashboard/plugins/select2/css/select2.min.css') }}" rel="stylesheet"/>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تعديل معلومات المخبر</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $laboratory->description ?? 'وصف غير متوفر' }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    @include('Dashboard.messages_allert')
    <div class="card">
        <div class="card-body">
            <!-- النموذج -->
            <form action="{{ route('staff.laboratory-update', $laboratory->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <!-- حقل الوصف -->
                <div class="form-group">
                    <label for="description">{{ __('messages.description') }}</label>
                    <textarea name="description" class="form-control" readonly>{{ $laboratory->description }}</textarea>
                </div>

                <!-- حقل رقم الفاتورة -->
                <div class="form-group">
                    <label for="invoice_id">{{ __('messages.invoice_number') }}</label>
                    <input type="text" name="invoice_id" class="form-control" value="{{ $laboratory->invoice_id }}" readonly>
                </div>

                <!-- حقل المريض -->
                <div class="form-group">
                    <label for="patient_id">{{ __('messages.patient') }}</label>
                    <input type="text" name="patient" class="form-control" value="{{ $laboratory->patient->name }}" readonly>
                </div>

                <!-- حقل الطبيب -->
                <div class="form-group">
                    <label for="doctor_id">{{ __('messages.doctor') }}</label>
                    <input type="text" name="doctor" class="form-control" value="{{ $laboratory->doctor->name }}" readonly>
                </div>

                <!-- حقل وصف الموظف -->
                <div class="form-group">
                    <label for="staff_description">{{ __('messages.staff_description') }}</label>
                    <input type="text" name="staff_description" class="form-control" value="{{ $laboratory->staff_description }}">
                </div>

                <!-- حقل تاريخ التعيين -->
                <div class="form-group">
                    <label for="staff_date">{{ __('messages.staff_date') }}</label>
                    <input type="date" name="staff_date" class="form-control" value="{{ $laboratory->staff_date }}">
                </div>

                <!-- حقل الصور الحالية -->
                <div class="form-group">
                    <label for="images">{{ __('messages.current_images') }}</label>
                    @if($laboratory->images && $laboratory->images->count() > 0)
                        <div class="d-flex">
                            @foreach($laboratory->images as $image)
                                <img src="{{ asset('Dashboard/img/Laboratory/Send/'.$laboratory->patient->name.'/'.$laboratory->id.'/'.$image->filename) }}" style="width: 100px; margin-right: 10px;">
                            @endforeach
                        </div>
                    @else
                        <p>{{ __('messages.no_images') }}</p>
                    @endif
                </div>

                <!-- رفع صور جديدة -->
                <div class="form-group">
                    <label for="images">
                        <i class="fas fa-upload"></i> {{ __('messages.upload_new_images') }}
                    </label>
                    <input type="file" class="form-control" id="images" name="images[]" accept="image/*" multiple onchange="previewImages(event)">
                </div>
                <input type="hidden" name="type" value="1">

                <!-- معاينة الصور المرفوعة -->
                <div class="form-group text-center" id="imagePreviewContainer" style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
                    <!-- سيتم عرض الصور هنا بعد الرفع -->
                </div>

                <!-- زر الحفظ والرجوع -->
                <div class="form-group">
                    <a href="#" class="btn btn-secondary">{{ __('messages.back') }}</a>
                    <input type="submit" value="{{ __('messages.save_changes') }}" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection


@section('js')
    <script src="{{ URL::asset('Dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        // عرض معاينة للصور المرفوعة
        function previewImages(event) {
            var imagePreviewContainer = document.getElementById('imagePreviewContainer');
            imagePreviewContainer.innerHTML = ""; // مسح المعاينة السابقة

            for (var i = 0; i < event.target.files.length; i++) {
                var reader = new FileReader();

                reader.onload = (function(fileIndex) {
                    return function(event) {
                        var img = document.createElement('img');
                        img.src = event.target.result;
                        img.alt = 'معاينة الصورة';
                        img.style.maxWidth = '150px';
                        img.style.height = 'auto';
                        img.style.border = '2px solid #ddd';
                        img.style.padding = '5px';
                        img.style.marginTop = '10px';
                        img.style.borderRadius = '8px';

                        imagePreviewContainer.appendChild(img);
                    };
                })(i);

                reader.readAsDataURL(event.target.files[i]);
            }
        }
    </script>
@endsection

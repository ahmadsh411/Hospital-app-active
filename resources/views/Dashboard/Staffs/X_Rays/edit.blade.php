@extends('Dashboard.layouts.Staff.master_staff')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">عرض تفاصيل الإشعاع</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{$ray->description}}</span>
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
                    <label for="description">الوصف</label>
                    <input type="text" name="description" class="form-control" value="{{ $ray->description }}" readonly>
                </div>

                <!-- حقل المريض -->
                <div class="form-group">
                    <label for="patient_id">المريض</label>
                    <input type="text" name="patient" class="form-control" value="{{ $ray->patient->name }}" readonly>
                </div>

                <!-- حقل الطبيب -->
                <div class="form-group">
                    <label for="doctor_id">الطبيب</label>
                    <input type="text" name="doctor" class="form-control" value="{{ $ray->doctor->name }}" readonly>
                </div>



                <!-- حقل وصف الموظف (staff_description) -->
                <div class="form-group">
                    <label for="staff_description">وصف الموظف</label>
                    <input type="text" name="staff_description" class="form-control"  >
                </div>
                <!-- حقل تاريخ الإشعاع (staff_date) -->


                <!-- حقل الصور -->
                <div class="form-group">
                    <label for="images">الصور الحالية</label>
                    @if($ray->images->count() > 0)
                        <div class="d-flex">
                            @foreach($ray->images as $image)
                                <img src="{{ asset('Dashboard/img/x-rays/'.$ray->patient->name.'/send/'.$ray->id.'/'.$image->filename) }}" style="width: 100px; margin-right: 10px;">
                            @endforeach
                        </div>
                    @else
                        <p>لا توجد صور حالية.</p>
                    @endif
                    <br>
                    <br>
                    <br>
                    <input type="hidden" value="1" name="type">

                    <div class="form-group">
                        <label for="image">
                            <i class="fas fa-upload"></i> رفع صورة الأشعة
                        </label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                    </div>
                </div>

                <!-- زر الرجوع -->
                <div class="form-group">
                    <a href="{{ route('staff.x-rays') }}" class="btn btn-secondary">الرجوع</a>
                    <input type="submit" value="تم" class="btn btn-primary" />
                </div>

                <div class="form-group text-center">
                    <img id="imagePreview" src="" alt="معاينة الصورة" style="max-width: 100%; height: auto; display: none; border: 2px solid #ddd; padding: 5px; margin-top: 10px;">
                </div>

            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset('Dashboard/plugins/select2/js/select2.min.js')}}"></script>
    <script>
        // JavaScript لعرض معاينة الصورة عند اختيار ملف
        function previewImage(event) {
            var reader = new FileReader();
            var imagePreview = document.getElementById('imagePreview');

            reader.onload = function() {
                if (reader.readyState === 2) {
                    imagePreview.src = reader.result;
                    imagePreview.style.display = 'block';
                }
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection

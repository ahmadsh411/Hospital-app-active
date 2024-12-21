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
                <h4 class="content-title mb-0 my-auto">{{ __('messages.edit') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.laboratory') }}</span>
            </div>

        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')

    <form method="POST" action="{{ route('laboratories.update', ['laboratory' => $laboratory->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Description Field -->
        <div class="form-group">
            <label for="editInput">{{ __('messages.edit_field') }}</label>
            <textarea type="text" class="form-control" name="description" id="editInput" placeholder="{{ __('messages.enter_changes') }}">{{ $laboratory->description }}</textarea>
            <input type="hidden" name="invoice_id" value="{{ $laboratory->invoice->id }}">
            <input type="hidden" name="doctor_id" value="{{ $laboratory->doctor->id }}">
            <input type="hidden" name="patient_id" value="{{ $laboratory->patient->id }}">
            <input type="hidden" value="{{ $laboratory->id }}">
        </div>

        <!-- Upload Image Field -->
        <div class="form-group">
            <label for="image">
                <i class="fas fa-upload"></i> {{ __('messages.upload_analysis_image') }}
            </label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" onchange="previewImage(event)">
        </div>

        <!-- Current Image Display -->
        <div class="form-group text-center">
            @if(isset($laboratory->images))
                @foreach($laboratory->images as $image)
                    <img src="{{ asset('Dashboard/img/Laboratory/Send/'.$laboratory->patient->name.'/'.$laboratory->id.'/'.$image->filename) }}"
                         style="width: 100px; margin-right: 10px;">
                @endforeach
            @endif

            <img id="imagePreview12" src="" alt="{{ __('messages.image_preview') }}"
                 style="max-width: 100%; height: 75%; display: none; border: 2px solid #ddd; padding: 5px; margin-top: 10px;">
        </div>

        <!-- Submit Button -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('messages.save_changes') }}</button>
        </div>
    </form>


@endsection

@section('js')
    <!-- مكتبة الجافاسكريبت لـ Bootstrap (لو مش مضافة في مشروعك) -->


    <!-- Internal Data tables -->
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>

    <!-- Internal Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>

    <!-- JavaScript لعرض معاينة الصورة عند اختيار ملف -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            var imagePreview = document.getElementById('imagePreview12');

            reader.onload = function () {
                if (reader.readyState === 2) {
                    imagePreview.src = reader.result;
                    imagePreview.style.display = 'block';
                }
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection

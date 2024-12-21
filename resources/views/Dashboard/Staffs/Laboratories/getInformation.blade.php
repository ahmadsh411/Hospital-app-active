@extends('Dashboard.layouts.Staff.master_staff')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <style>
        /* الخلفية الكروية */
        .background-bubbles { /* نفس كود الفقاعات السابق */
        }

        .bubble { /* نفس كود الفقاعات السابق */
        }

        /* نافذة تكبير الصورة */
        #imageModal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s ease;
        }

        #imageModal img {
            max-width: 80%;
            max-height: 80%;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.6);
        }

        .close-btn, .nav-btn {
            position: absolute;
            font-size: 30px;
            color: white;
            cursor: pointer;
            transition: color 0.3s ease;
            user-select: none;
        }

        .close-btn {
            top: 20px;
            right: 40px;
        }

        .nav-btn {
            top: 50%;
            transform: translateY(-50%);
        }

        .nav-btn:hover, .close-btn:hover {
            color: #f1f1f1;
        }

        .prev {
            left: 20px;
        }

        .next {
            right: 20px;
        }
    </style>
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">تفاصيل الفحص</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/معلومات التحليل</span>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="background-bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>

    <div class="container mt-5">
        <h2 class="text-primary">{{ __('messages.laboratory_details_for') }}: {{ $laboratory->patient->name }}</h2>

        <div class="card shadow-lg mb-4">
            <div class="card-body">
                <h5 class="text-info">{{ __('messages.laboratory_info') }}</h5>
                <p><strong>{{ __('messages.patient_name') }}:</strong> {{ $laboratory->patient->name }}</p>
                <p><strong>{{ __('messages.description') }}:</strong> {{ $laboratory->description ?? __('messages.no_description') }}</p>
                <p><strong>{{ __('messages.status') }}:</strong> {{ $laboratory->status ? __('messages.completed') : __('messages.not_completed') }}</p>
                <p><strong>{{ __('messages.exam_date') }}:</strong> {{ $laboratory->staff_date }}</p>
            </div>
        </div>

        <!-- قسم الصور المرسلة -->
        <div class="card shadow-lg mb-4">
            <div class="card-body">
                <h5 class="text-info">{{ __('messages.sent_images') }}:</h5>
                <div class="d-flex flex-wrap">
                    @php $sendImages = $laboratory->images->where('type', 0); @endphp
                    @if($sendImages->count() > 0)
                        @foreach($sendImages as $index => $image)
                            <img
                                src="{{ asset('Dashboard/img/Laboratory/Send/'.$laboratory->patient->name.'/'.$laboratory->id.'/'.$image->filename) }}"
                                class="img-thumbnail m-2"
                                style="width: 150px; height: 150px; cursor: pointer;"
                                onclick="openModal({{ $index }}, 'send')">
                        @endforeach
                    @else
                        <p>{{ __('messages.no_images') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- قسم الصور المستلمة من المخبر -->
        <div class="card shadow-lg mb-4">
            <div class="card-body">
                <h5 class="text-info">{{ __('messages.received_images') }}:</h5>
                <div class="d-flex flex-wrap">
                    @php
                        $readyImages = $laboratory->images->where('type', 1);
                    @endphp
                    @foreach($readyImages as $index => $image)
                        <img
                            src="{{asset('Dashboard/img/Laboratory/Returned/'.$laboratory->patient->name.'/'.$laboratory->id.'/'.$image->filename) }}"
                            class="img-thumbnail m-2"
                            style="width: 150px; height: 150px; cursor: pointer;"
                            onclick="openModal({{ $index }}, 'ready')">
                    @endforeach
                </div>
            </div>
        </div>

        <!-- نافذة تكبير الصور -->
        <div id="imageModal" style="display: none; opacity: 0;">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <span class="nav-btn prev" onclick="changeImage(-1)">&lsaquo;</span>
            <img id="modalImage" src="" alt="{{ __('messages.zoomed_image') }}">
            <span class="nav-btn next" onclick="changeImage(1)">&rsaquo;</span>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="text-info">{{ __('messages.staff_info') }}</h5>
                <p><strong>{{ __('messages.staff_name') }}:</strong> {{ $laboratory->staff_name ?? __('messages.not_available') }}</p>
                <p><strong>{{ __('messages.staff_description') }}:</strong> {{ $laboratory->staff_description ?? __('messages.not_available') }}</p>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h5 class="text-info">{{ __('messages.additional_links') }}</h5>
                <p><strong>{{ __('messages.doctor') }}:</strong> {{ $laboratory->doctor->name ?? __('messages.not_available') }}</p>
            </div>
        </div>
    </div>
@endsection


@section('js')
    <script>
        let currentImageIndex = 0;
        let currentType = ''; // تحديد نوع الصور المفتوحة حاليًا

        // مصفوفات الصور المنفصلة
        let images = {
            'send': [
                @foreach($sendImages as $image)
                    "{{ asset('Dashboard/img/Laboratory/Send/' . $laboratory->patient->name . '/' . $laboratory->id . '/' . $image->filename) }}",
                @endforeach
            ],
            'ready': [
                @foreach($readyImages as $image)
                    "{{ asset('Dashboard/img/Laboratory/Returned/' . $laboratory->patient->name . '/' . $laboratory->id . '/' . $image->filename) }}",
                @endforeach
            ]
        };

        // دالة فتح النافذة مع تعيين المصفوفة المناسبة
        function openModal(index, type) {
            currentImageIndex = index;
            currentType = type;
            document.getElementById('modalImage').src = images[currentType][currentImageIndex];

            let modal = document.getElementById('imageModal');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.style.opacity = '1';
            }, 10);
        }

        // دالة إغلاق النافذة
        function closeModal() {
            let modal = document.getElementById('imageModal');
            modal.style.opacity = '0';
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300);  // الانتظار حتى انتهاء تأثير الاختفاء قبل تغيير العرض
        }

        // دالة التنقل بين الصور في نفس المصفوفة
        function changeImage(step) {
            let totalImages = images[currentType].length;
            currentImageIndex = (currentImageIndex + step + totalImages) % totalImages;
            document.getElementById('modalImage').src = images[currentType][currentImageIndex];
        }
    </script>

@endsection

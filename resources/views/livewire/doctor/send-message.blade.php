<div>
    @extends('Dashboard.layouts.Doctor.master_doctor')
    @section('css')
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ __('messages.conversations') }}</h4>
                    <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.recent') }}</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
                </div>
                <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
                </div>
                <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
                </div>
                <div class="mb-3 mb-xl-0">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary">14 Aug 2019</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                            <a class="dropdown-item" href="#">2015</a>
                            <a class="dropdown-item" href="#">2016</a>
                            <a class="dropdown-item" href="#">2017</a>
                            <a class="dropdown-item" href="#">2018</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
    @endsection
    @section('content')
        <!-- row -->
        <div class="row row-sm main-content-app mb-4">
            <!-- قائمة المحادثات -->
            @livewire("doctor.listchat")

            <!-- محتوى المحادثة -->
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <!-- زر الرجوع -->
                    <a class="main-header-arrow" href="" id="ChatBodyHide">
                        <i class="icon ion-md-arrow-back"></i>
                    </a>

                    <!-- مكون Livewire الخاص بإرسال الرسائل -->
                    @livewire("doctor.send")
                </div>
            </div>
        </div>
        <!-- row -->
    @endsection

    @section('js')
        <!--Internal  lightslider js -->
        <script src="{{URL::asset('Dashboard/plugins/lightslider/js/lightslider.min.js')}}"></script>
        <!--Internal  Chat js -->
        <script src="{{URL::asset('Dashboard/js/chat.js')}}"></script>
    @endsection
</div>


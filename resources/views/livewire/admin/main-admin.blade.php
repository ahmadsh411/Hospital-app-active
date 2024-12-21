<div>
    @extends('Dashboard.layouts.Admin.master')
    @section('css')
    @endsection
    @section('page-header')
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="my-auto">
                <div class="d-flex">
                    <h4 class="content-title mb-0 my-auto">{{ __('messages.Conversations') }}</h4>
                    <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.Recent') }}</span>
                </div>
            </div>
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-info btn-icon ml-2">
                        <i class="mdi mdi-filter-variant"></i>
                    </button>
                </div>
                <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-danger btn-icon ml-2">
                        <i class="mdi mdi-star"></i>
                    </button>
                </div>
                <div class="pr-1 mb-3 mb-xl-0">
                    <button type="button" class="btn btn-warning btn-icon ml-2">
                        <i class="mdi mdi-refresh"></i>
                    </button>
                </div>
                <div class="mb-3 mb-xl-0">
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary">{{ __('messages.Date') }}</button>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">{{ __('messages.Toggle Dropdown') }}</span>
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
            @livewire("admin.listchat-admin")

            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <a class="main-header-arrow" href="" id="ChatBodyHide">
                        <i class="icon ion-md-arrow-back"></i>
                    </a>
                    @livewire("admin.sendmessage-admin")
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

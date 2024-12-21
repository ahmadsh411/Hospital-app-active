@extends('Dashboard.layouts.Staff.master_staff')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('messages.invoices_and_rays') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.all') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="accordion" id="invoicesAccordion">
        @foreach($invoices as $invoice)
            @if($invoice->rayes->count() > 0) <!-- هنا يتم التحقق إذا كانت الفاتورة تحتوي على إشعاعات -->
            @php
                $hasStaffName = false;  // علم للتحقق من وجود staff_name
            @endphp

                <!-- التحقق من جميع الإشعاعات إذا كان أي منها لا يحتوي على staff_name -->
            @foreach($invoice->rayes as $ray)
                @if(!$ray->staff_name)
                    @php
                        $hasStaffName = true;  // وجدنا إشعاع لا يحتوي على staff_name
                    @endphp
                @endif
            @endforeach

            <!-- إظهار البطاقة فقط إذا كان $hasStaffName == true (أي إذا كان هناك إشعاع لا يحتوي على staff_name) -->
            @if($hasStaffName)
                <div class="card">
                    <div class="card-header" id="heading-{{$invoice->id}}">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse-{{$invoice->id}}" aria-expanded="false" aria-controls="collapse-{{$invoice->id}}">
                                {{ __('messages.rays_associated_with') }} #{{$invoice->patient->name}}
                            </button>
                        </h5>
                    </div>
                    <div id="collapse-{{$invoice->id}}" class="collapse" aria-labelledby="heading-{{$invoice->id}}" data-parent="#invoicesAccordion">
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('messages.description') }}</th>
                                    <th>{{ __('messages.patient') }}</th>
                                    <th>{{ __('messages.doctor') }}</th>
                                    <th>{{ __('messages.attached_image') }}</th>
                                    <th>{{ __('messages.operations') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoice->rayes as $ray)
                                    @if(!$ray->staff_name) <!-- إظهار فقط الإشعاعات التي لا تحتوي على staff_name -->
                                    <tr>
                                        <td>{{$ray->description}}</td>
                                        <td>{{$ray->patient->name}}</td>
                                        <td>{{$ray->doctor->name}}</td>
                                        <td>
                                            @if($ray->images->count()>0)
                                                @foreach($ray->images as $image)
                                                    @if($image->type==0)
                                                        <img src="{{ asset('Dashboard/img/x-rays/'.$ray->patient->name.'/send/'.$ray->id.'/'.$image->filename) }}"
                                                             style="width: 150px; border-radius: 10%; height: 80px; margin-right: 10px;">
                                                    @endif
                                                @endforeach
                                            @else
                                                <strong>{{ __('messages.no_images') }}</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if($ray->status==0)
                                                <a href="{{route('staff.x-ray-edit',['id'=>$ray->id])}}" class="btn btn-success" >
                                                    <i class="fas fa-plus"></i> {{ __('messages.complete_ray') }}
                                                </a>

                                            @else
                                                <strong>{{ __('messages.ray_completed') }}</strong>

                                            @endif

                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            @endif
        @endforeach
    </div>
@endsection


@section('js')
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
@endsection

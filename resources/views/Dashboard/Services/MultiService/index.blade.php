@extends('Dashboard.layouts.Admin.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="services-section">
            <h3>{{ __('messages.all_services') }}</h3>
            <p>{{ __('messages.services_description') }}</p>

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
                <button type="button" class="btn btn-warning  btn-icon ml-2">
                    <i class="mdi mdi-refresh"></i>
                </button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                         data-x-placement="bottom-end">
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
    <!-- row opened -->
    <div class="row row-sm">
        <!-- إضافة زر لإضافة خدمة جديدة -->
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#add">
            <i class="mdi mdi-plus-circle-outline"></i> {{ __('messages.add_service') }}
        </button>
        @include('Dashboard.Services.MultiService.add')

        <!-- بداية الجدول -->
        <div class="col-xl-12">
            <div class="card mg-b-20">

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">{{ __('messages.name') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.notes') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.quantity') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.price_before_discount') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.discount_value') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.price_after_discount') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.tax') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.final_price') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.total_with_tax') }}</th>
                                    <th class="border-bottom-0">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($multiservices as $service)
                                    <tr class="text-center">
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->notes }}</td>
                                        <td>{{ $service->service_group->sum('pivot.quantity') }}</td>
                                        <td>{{ $service->total_before_discount }}</td>
                                        <td>{{ $service->discount_value }}</td>
                                        <td>{{ $service->total_after_discount }}</td>
                                        <td>{{ $service->tax_rate }}%</td>
                                        <td>{{ $service->total_with_tax }}</td>
                                        <td>{{ $service->total_with_tax }}</td>
                                        <td>
                                            <div class="d-inline-flex">
                                                <!-- زر التحديث -->
                                                <button type="button" class="btn btn-outline-info btn-sm mx-1" onclick="func2()">
                                                    <i class="mdi mdi-pencil"></i> {{ __('messages.update') }}
                                                </button>
                                                <script>
                                                    function func2() {
                                                        window.location.href = "{{ route('multi-services.edit', ['multi_service' => $service->id]) }}";
                                                    }
                                                </script>

                                                <!-- زر الحذف -->
                                                <button type="button" class="btn btn-outline-danger btn-sm mx-1" data-toggle="modal" data-target="#delete{{$service->id}}">
                                                    <i class="mdi mdi-delete"></i> {{ __('messages.delete') }}
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                    @include('Dashboard.Services.MultiService.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- نهاية الجدول -->
    </div>

@endsection

@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
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
    <script>
        // لإضافة خدمة جديدة مع الكمية
        document.getElementById('addServiceBtn').addEventListener('click', function () {
            const container = document.getElementById('services-container');
            const newServiceItem = container.querySelector('.service-item').cloneNode(true);

            // إعادة تعيين الحقول المكررة
            newServiceItem.querySelector('select').value = "#"; // إعادة تعيين الاختيار
            newServiceItem.querySelector('input[type="number"]').value = 0; // إعادة تعيين الكمية

            // إضافة العنصر الجديد إلى الحاوية
            container.appendChild(newServiceItem);
        });
    </script>
    <!-- إضافة Script للوظيفة -->
    <script>
        $(document).ready(function () {
            // وظيفة زر إضافة خدمة جديدة
            $('#addServiceBtn').on('click', function () {
                // الحصول على حاوية الخدمات
                var container = $('#services-container');

                // إنشاء عنصر جديد للخدمة
                var serviceItem = $('<div>', {class: 'service-item'});

                // إنشاء select الخاص بالخدمات
                var select = $('<select>', {
                    class: 'form-control',
                    name: 'service_id[]'
                });

                // إضافة الخيار الافتراضي
                var optionDefault = $('<option>', {
                    value: '',
                    text: 'Choose The Service',
                    disabled: true,
                    selected: true
                });
                select.append(optionDefault);

                // إضافة الخدمات
                @foreach($singleServices as $singleService)
                var option = $('<option>', {
                    value: "{{$singleService->id}}",
                    text: "{{$singleService->name}}: {{$singleService->price}}$"
                });
                select.append(option);
                @endforeach

                // إضافة select إلى العنصر الجديد
                serviceItem.append(select);
                serviceItem.append('<br>');

                // إضافة حقل الإدخال الخاص بالكمية
                var quantityLabel = $('<label>').text('Quantity');
                var quantityInput = $('<input>', {
                    type: 'number',
                    name: 'quantity_[]',
                    class: 'form-control'
                });

                serviceItem.append(quantityLabel);
                serviceItem.append(quantityInput);
                serviceItem.append('<br>');

                // زر لحذف الخدمة
                var removeBtn = $('<button>', {
                    type: 'button',
                    class: 'btn btn-danger remove-service-btn',
                    text: 'Remove Service'
                });

                serviceItem.append(removeBtn);
                serviceItem.append('<hr>');

                // إضافة العنصر الجديد إلى الحاوية
                container.append(serviceItem);

                // وظيفة زر الحذف
                removeBtn.on('click', function () {
                    serviceItem.remove();
                });
            });

            // تفعيل زر الحذف للخدمات الحالية
            $('.remove-service-btn').on('click', function () {
                $(this).closest('.service-item').remove();
            });
        });
    </script>
@endsection

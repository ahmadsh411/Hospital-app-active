@extends('Dashboard.layouts.Admin.master')
@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Tables</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Data Tables</span>
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
                <button type="button" class="btn btn-warning  btn-icon ml-2">
                    <i class="mdi mdi-refresh"></i>
                </button>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            <div class="row justify-content-between align-items-center">
                <!-- العمود الخاص بالعنوان إلى اليمين -->
                <div class="col-auto text-right">
                    <h5>Update Service</h5>
                </div>

                <!-- العمود الخاص بالقيمة إلى اليسار -->
                <div class="card" style="background-color: #f1f9ff; border: 1px solid #0a7ffb;">
                    <div class="card-body">
                        <div class="row">
                            <!-- القسم باليسار مع خلفية ولون مميز -->
                            <div class="col-auto text-left">
                                <label style="color: #0a7ffb; font-weight: bold;">Total with Tax</label>
                                <h5 id="total_with_tax">{{ $multiservice->total_with_tax }}</h5>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="card-body">
            <!-- نموذج التحديث -->
            <form action="{{ route('multi-services.update', ['multi_service' => $multiservice->id]) }}" method="POST"
                  autocomplete="off" id="updateForm">
                @csrf
                @method('PUT')

                <!-- إدخال اسم الخدمة -->
                <div class="form-group">
                    <label for="service_name">Service Name</label>
                    <input type="text" id="service_name" name="name" value="{{ $multiservice->name }}"
                           class="form-control">
                </div>

                <!-- ملاحظات حول الخدمة -->
                <div class="form-group">
                    <label for="service_notes">Service Notes</label>
                    <textarea id="service_notes" name="notes" class="form-control">{{ $multiservice->notes }}</textarea>
                </div>

                <!-- حاوية الخدمات -->
                <div id="services-container">
                    @foreach($multiservice->service_group as $service)
                        <div class="service-item row">
                            <div class="col-md-6">
                                <label for="service_id">Choose The Service</label>
                                <select class="form-control" name="service_id[]" onchange="calculateTotal()">
                                    @foreach($singleServices as $singleService)
                                        <option value="{{ $singleService->id }}"
                                                {{ $service->id == $singleService->id ? 'selected' : '' }}
                                                data-price="{{ $singleService->price }}">
                                            {{ $singleService->name }}: {{ $singleService->price }}$
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="quantity_">Quantity</label>
                                <input type="number" name="quantity_[]" value="{{ $service->pivot->quantity }}"
                                       class="form-control" oninput="calculateTotal()">
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-danger mt-4 remove-service-btn"
                                        onclick="removeService(this)">Remove Service
                                </button>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>

                <!-- زر لإضافة خدمة جديدة -->
                <button type="button" id="addServiceBtn" class="btn btn-primary mt-3">Add Another Service</button>

                <br><br>

                <!-- إدخال قيمة الخصم -->
                <div class="form-group">
                    <label for="discount_value">Discount Value</label>
                    <input type="text" name="discount_value" value="{{ $multiservice->discount_value }}"
                           class="form-control" id="discount_value" oninput="calculateTotal()">
                </div>

                <!-- إدخال نسبة الضريبة -->
                <div class="form-group">
                    <label for="tax_rate">Tax Rate</label>
                    <input type="number" name="tax_rate" value="{{ $multiservice->tax_rate }}" class="form-control"
                           id="tax_rate" oninput="calculateTotal()">
                </div>

                <!-- زر حفظ التحديث -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#addServiceBtn').on('click', function () {
                var container = $('#services-container');

                // إنشاء عنصر جديد للخدمة
                var serviceItem = $('<div>', {class: 'service-item row'});
                var selectService = $('<select>', {
                    class: 'form-control col-md-6',
                    name: 'service_id[]',
                    onchange: 'calculateTotal()'
                });
                var optionDefault = $('<option>', {
                    value: '',
                    text: 'Choose The Service',
                    disabled: true,
                    selected: true
                });
                selectService.append(optionDefault);

                @foreach($singleServices as $singleService)
                var option = $('<option>', {
                    value: "{{ $singleService->id }}",
                    text: "{{ $singleService->name }}: {{ $singleService->price }}$",
                    'data-price': "{{ $singleService->price }}"
                });
                selectService.append(option);
                @endforeach

                var quantityInput = $('<input>', {
                    type: 'number',
                    name: 'quantity_[]',
                    class: 'form-control col-md-3',
                    placeholder: 'Enter quantity',
                    value: 1,
                    oninput: 'calculateTotal()'
                });

                var removeBtn = $('<button>', {
                    type: 'button',
                    class: 'btn btn-danger col-md-3 mt-4 remove-service-btn',
                    text: 'Remove',
                    onclick: 'removeService(this)'
                });

                serviceItem.append(selectService, quantityInput, removeBtn);
                container.append(serviceItem);
            });

            $('.remove-service-btn').on('click', function () {
                $(this).closest('.service-item').remove();
                calculateTotal();  // إعادة حساب الإجمالي بعد الحذف
            });
        });

        function removeService(element) {
            $(element).closest('.service-item').remove();
            calculateTotal();  // إعادة حساب الإجمالي بعد الحذف
        }

        function calculateTotal() {
            var totalBeforeDiscount = 0;
            var discount = parseFloat($('#discount_value').val()) || 0;
            var taxRate = parseFloat($('#tax_rate').val()) || 0;

            $('select[name="service_id[]"]').each(function (index, element) {
                var price = parseFloat($(element).find(':selected').data('price')) || 0;
                var quantity = parseFloat($('input[name="quantity_[]"]').eq(index).val()) || 0;
                totalBeforeDiscount += price * quantity;
            });

            var totalAfterDiscount = totalBeforeDiscount - discount;
            var totalTax = (totalAfterDiscount * taxRate) / 100;
            var totalWithTax = totalAfterDiscount + totalTax;

            // عرض النتائج في الواجهة
            $('#total_with_tax').text(totalWithTax.toFixed(2) + " $");
        }
    </script>
@endsection



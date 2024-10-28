@extends('Dashboard.layouts.Admin.master')

@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>




    <style>

        body {
            background-color: #f7f7f7;
            padding: 2rem;
        }

        .container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 1rem;
            border-radius: 8px 8px 0 0;
        }

        .form-control[readonly] {
            background-color: #e9ecef;
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Update</span>
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

    <div>
        @include('Dashboard.messages_allert')
        <form action="{{ route('invoices.update', ['invoice' => $singleInvoice->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mt-4">
                <!-- Patient -->
                <div class="form-group col-md-6">
                    <label for="patient_id">Patient</label>
                    <select class="form-control" id="patient_id" name="patient_id" required>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $patient->id == $singleInvoice->patient->id ? 'selected' : '' }}>
                                {{ $patient->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Doctor -->
                <div class="form-group col-md-6">
                    <label for="doctor_id">Doctor</label>
                    <select class="form-control" id="doctor_id" name="doctor_id" required>
                        <option value="">Select Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" data-section-id="{{ $doctor->section->id }}"
                                    data-section-name="{{ $doctor->section->name }}" {{ $doctor->id == $singleInvoice->doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Section (Hidden ID and visible Name) -->
                <input type="hidden" class="form-control" id="section_id" name="section_id"
                       value="{{ $singleInvoice->section->id }}" readonly>
                <div class="form-group col-md-6">
                    <label for="section_name">Section Name</label>
                    <input type="text" class="form-control" id="section_name"
                           value="{{ $singleInvoice->section->name }}" readonly>
                </div>

                <script>
                    document.getElementById('doctor_id').addEventListener('change', function () {
                        var selectedDoctor = this.options[this.selectedIndex];
                        var sectionId = selectedDoctor.getAttribute('data-section-id');
                        var sectionName = selectedDoctor.getAttribute('data-section-name');

                        document.getElementById('section_id').value = sectionId ? sectionId : '';
                        document.getElementById('section_name').value = sectionName ? sectionName : '';
                    });
                </script>

                <!-- Service Type -->
                <div class="form-group col-md-6">
                    <label for="service_type">Service Type</label>
                    <select class="form-control" id="service_type" name="service_type" required>
                        <option value="" disabled>Select Service Type</option>
                        <option value="single" {{ $singleInvoice->service_id ? 'selected' : '' }}>Single Service
                        </option>
                        <option value="grouped" {{ $singleInvoice->group_id ? 'selected' : '' }}>Grouped Services
                        </option>
                    </select>
                </div>

                <!-- Single Service -->
                <div class="form-group col-md-6" id="single_service_container"
                     style="display: {{ $singleInvoice->service_id ? 'block' : 'none' }};">
                    <label for="single_service_id">Single Service</label>
                    <select class="form-control" id="single_service_id" name="service_id">
                        <option value="">Select Single Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}"
                                    data-price="{{ $service->price }}" {{ $singleInvoice->service_id == $service->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Grouped Services -->
                <div class="form-group col-md-6" id="grouped_service_container"
                     style="display: {{ $singleInvoice->group_id ? 'block' : 'none' }};">
                    <label for="grouped_service_id">Grouped Services</label>
                    <select class="form-control" id="grouped_service_id" name="group_id">
                        <option value="">Select Grouped Services</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}"
                                    data-total="{{ $group->total_before_discount }}"
                                    data-discount="{{ $group->discount_value }}"
                                    data-tax-rate="{{ $group->tax_rate }}"
                                    {{ $singleInvoice->group_id == $group->id ? 'selected' : '' }}>
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price -->
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                           value="{{ $singleInvoice->price }}" required readonly>
                </div>

                <!-- Discount -->
                <div class="form-group col-md-6">
                    <label for="discount_value">Discount</label>
                    <input type="number" step="0.01" class="form-control" id="discount_value" name="discount_value"
                           value="{{ $singleInvoice->discount_value }}" required>
                </div>

                <!-- Tax Rate -->
                <div class="form-group col-md-6">
                    <label for="tax_rate">Tax Rate</label>
                    <input type="number" step="0.01" class="form-control" id="tax_rate" name="tax_rate"
                           value="{{ $singleInvoice->tax_rate }}" required>
                </div>

                <!-- Tax Value -->
                <div class="form-group col-md-6">
                    <label for="tax_value">Tax Value</label>
                    <input type="number" step="0.01" class="form-control" id="tax_value" name="tax_value"
                           value="{{ $singleInvoice->tax_value }}" readonly>
                </div>

                <!-- Total with Tax -->
                <div class="form-group col-md-6">
                    <label for="tot_with_tax">Total with Tax</label>
                    <input type="number" step="0.01" class="form-control" id="tot_with_tax" name="tot_with_tax"
                           value="{{ $singleInvoice->tot_with_tax }}" readonly>
                </div>

                <!-- Invoice Type -->
                <div class="form-group col-md-6">
                    <label for="type">Invoice Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="" disabled>Select Type</option>
                        @if ($singleInvoice->type==1)
                            <option value="1" selected>monetary</option>
                            <option value="0">Postponed</option>
                        @else
                            <option value="0" selected>Postponed</option>

                        @endif
                    </select>
                </div>

                <!-- Invoice Status -->
                {{-- <div class="form-group col-md-6">
                    <label for="invoice_status">Invoice Status</label>
                    <select class="form-control" id="invoice_status" name="type" required>
                        <option value="" disabled>Select Status</option>
                        <option value="1" {{ $singleInvoice->type == 1 ? 'selected' : '' }}>Paid</option>
                        <option value="0" {{ $singleInvoice->type == 0 ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div> --}}


                <div class="form-group col-md-6">
                    <label for="doctor_id">Invoice status</label>
                    <select class="form-control" id="type" name="invoice_status" required>
                        <option value="" disabled>Select Status</option>
                        <option value="1" {{ $singleInvoice->invoice_status == 1 ? 'selected' : '' }}>كشف منتهي</option>
                        <option value="0" {{ $singleInvoice->invoice_status == 0 ? 'selected' : '' }}>تحت الكشف</option>

                    </select>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        <!-- JavaScript to handle service type change and calculations -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Set the initial service type display
                var serviceType = "{{ $singleInvoice->service_id ? 'single' : ($singleInvoice->group_id ? 'grouped' : '') }}";
                document.getElementById('service_type').value = serviceType;

                if (serviceType === 'single') {
                    document.getElementById('single_service_container').style.display = 'block';
                    document.getElementById('grouped_service_container').style.display = 'none';
                } else if (serviceType === 'grouped') {
                    document.getElementById('single_service_container').style.display = 'none';
                    document.getElementById('grouped_service_container').style.display = 'block';
                }

                // Handle service type change
                document.getElementById('service_type').addEventListener('change', function () {
                    var serviceType = this.value;
                    if (serviceType === 'single') {
                        document.getElementById('single_service_container').style.display = 'block';
                        document.getElementById('grouped_service_container').style.display = 'none';
                    } else if (serviceType === 'grouped') {
                        document.getElementById('single_service_container').style.display = 'none';
                        document.getElementById('grouped_service_container').style.display = 'block';
                    } else {
                        document.getElementById('single_service_container').style.display = 'none';
                        document.getElementById('grouped_service_container').style.display = 'none';
                    }
                    document.getElementById('price').value = ''; // Reset price
                });

                // Update price, discount, and tax based on selected grouped service
                document.getElementById('grouped_service_id').addEventListener('change', function () {
                    var selectedGroup = this.options[this.selectedIndex];
                    document.getElementById('price').value = selectedGroup.getAttribute('data-total') || '';
                    document.getElementById('discount_value').value = selectedGroup.getAttribute('data-discount') || '';
                    document.getElementById('tax_rate').value = selectedGroup.getAttribute('data-tax-rate') || '';
                    calculateInvoice();
                });

                // Calculate total with tax
                function calculateInvoice() {
                    var price = parseFloat(document.getElementById('price').value) || 0;
                    var discount = parseFloat(document.getElementById('discount_value').value) || 0;
                    var taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;
                    var totalBeforeTax = price - discount;
                    var taxValue = (totalBeforeTax * taxRate) / 100;
                    var totalWithTax = totalBeforeTax + taxValue;
                    document.getElementById('tax_value').value = taxValue.toFixed(2);
                    document.getElementById('tot_with_tax').value = totalWithTax.toFixed(2);
                }

                // Recalculate when values change
                document.getElementById('price').addEventListener('input', calculateInvoice);
                document.getElementById('discount_value').addEventListener('input', calculateInvoice);
                document.getElementById('tax_rate').addEventListener('input', calculateInvoice);
            });
        </script>

    </div>
    </div>
    </div>
    </div>

    <!-- JavaScript to handle calculations -->
    <script>
        // Function to calculate the total with tax
        function calculateInvoice() {
            var price = parseFloat(document.getElementById('price').value) || 0;
            var discount = parseFloat(document.getElementById('discount_value').value) || 0;
            var taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;

// الحساب قبل الضريبة وبعد الخصم
            var totalBeforeTax = price - discount;
// حساب قيمة الضريبة
            var taxValue = (totalBeforeTax * taxRate) / 100;
// المجموع النهائي بعد إضافة الضريبة
            var totalWithTax = totalBeforeTax + taxValue;

// تحديث الحقول تلقائيًا
            document.getElementById('tax_value').value = taxValue.toFixed(2);
            document.getElementById('tot_with_tax').value = totalWithTax.toFixed(2);
        }

        // إضافة أحداث عند تغيير الحقول للحساب
        document.getElementById('price').addEventListener('input', calculateInvoice);
        document.getElementById('discount_value').addEventListener('input', calculateInvoice);
        document.getElementById('tax_rate').addEventListener('input', calculateInvoice);
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
@section('js')
    <!-- Internal Data tables -->

    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
    <!-- JavaScript to handle calculations -->

@endsection

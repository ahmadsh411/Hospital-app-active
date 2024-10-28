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
    @include('Dashboard.messages_allert')
    <div>


        <form action="{{route('group-invoices.update',['group_invoice'=>$group->id])}}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mt-4">
                <!-- Patient -->
                <div class="form-group col-md-6">
                    <label for="patient_id">Patient</label>
                    <select class="form-control" id="patient_id" name="patient_id" required>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $patient->id == $group->patient->id ? 'selected' : '' }}>{{ $patient->name }}</option>
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
                                    data-section-name="{{ $doctor->section->name }}" {{ $doctor->id == $group->doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Section (Hidden ID and Visible Name) -->
                <input type="hidden" class="form-control" id="section_id" name="section_id"
                       value="{{ $group->section->id }}" readonly>
                <div class="form-group col-md-6">
                    <label for="section_name">Section Name</label>
                    <input type="text" class="form-control" id="section_name" value="{{ $group->section->name }}"
                           readonly>
                </div>

                <!-- JavaScript to auto-fill Section based on Doctor -->
                <script>
                    document.getElementById('doctor_id').addEventListener('change', function () {
                        var selectedDoctor = this.options[this.selectedIndex];
                        var sectionId = selectedDoctor.getAttribute('data-section-id');
                        var sectionName = selectedDoctor.getAttribute('data-section-name');

                        document.getElementById('section_id').value = sectionId ? sectionId : '';
                        document.getElementById('section_name').value = sectionName ? sectionName : '';
                    });
                </script>

                <!-- Service -->
                <div class="form-group col-md-6">
                    <label for="service_id">Service</label>
                    <select class="form-control" id="service_id" name="service_id" required>
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}"
                                    data-price="{{ $service->price }}" {{ $service->id == $group->multiservice->id ? 'selected' : '' }}>
                                {{ $service->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Price (Readonly) -->
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price"
                           value="{{ $group->price }}" readonly>
                </div>

                <script>
                    document.getElementById('service_id').addEventListener('change', function () {
                        var selectedService = this.options[this.selectedIndex];
                        var servicePrice = selectedService.getAttribute('data-price');
                        document.getElementById('price').value = servicePrice ? parseFloat(servicePrice).toFixed(2) : '';
                        calculateInvoice();
                    });
                </script>

                <!-- Discount -->
                <div class="form-group col-md-6">
                    <label for="discount_value">Discount</label>
                    <input type="number" step="0.01" class="form-control" id="discount_value" name="discount_value"
                           value="{{ $group->discount_value }}" required>
                </div>

                <!-- Tax Rate -->
                <div class="form-group col-md-6">
                    <label for="tax_rate">Tax Rate</label>
                    <input type="number" step="0.01" class="form-control" id="tax_rate" name="tax_rate"
                           value="{{ $group->tax_rate }}" required>
                </div>

                <!-- Tax Value (Readonly) -->
                <div class="form-group col-md-6">
                    <label for="tax_value">Tax Value</label>
                    <input type="number" step="0.01" class="form-control" id="tax_value" name="tax_value"
                           value="{{ $group->tax_value }}" readonly>
                </div>

                <!-- Total with Tax (Readonly) -->
                <div class="form-group col-md-6">
                    <label for="tot_with_tax">Total with Tax</label>
                    <input type="number" step="0.01" class="form-control" id="tot_with_tax" name="tot_with_tax"
                           value="{{ $group->tot_with_tax }}" readonly>
                </div>

                <div class="form-group col-md-6">
                    <label for="doctor_id">Invoice Type</label>
                    <select class="form-control" id="type" name="type" required>
                        @if ($group->type==1)
                            <option value="1" selected>monetary</option>
                            <option value="0">Postponed</option>
                        @else
                            <option value="0" selected>Postponed</option>

                        @endif

                    </select>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <script>
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

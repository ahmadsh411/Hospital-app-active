@extends('Dashboard.layouts.Admin.master')
@section('css')
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"/>
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>

@endsection
@section('page-header')

    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Receipt</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/ List</span>
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
    <!-- تعديل الرابط ليقوم بالتحديث -->
    <form action="{{ route('receipt-box.update',['receipt_box'=> $receipt->id]) }}" method="POST">
        @csrf
        @method('PUT') <!-- نحدد هنا طريقة PUT -->

        <div class="modal-body">
            <!-- حقل التاريخ -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <label for="date" class="form-label" style="font-weight: bold;">{{ __('messages.Date') }}</label>
                    <input type="date" class="form-control form-control-lg border-dark" id="date" name="date"
                           value="{{ $receipt->date }}" required readonly>
                </div>

                <!-- اختيار المريض -->
                <div class="col-md-6">
                    <label for="patient_id" class="form-label" style="font-weight: bold;">{{ __('messages.Beneficiary Name') }}</label>
                    <select class="form-select form-select-lg border-dark" id="patient_id" name="patient_id" required>
                        <option id="searchPatient" class="form-control mb-2"></option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" {{ $receipt->patient_id == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- حقل الديون -->
            <div class="row mb-4">
                <div class="col-12">
                    <label for="debit" class="form-label" style="font-weight: bold;">{{ __('messages.Amount') }}</label>
                    <input type="number" step="0.01" class="form-control form-control-lg border-dark" id="debit"
                           name="debit" value="{{ $receipt->debit }}" required>
                </div>
            </div>

            <!-- وصف السند -->
            <div class="row mb-4">
                <div class="col-12">
                    <label for="description" class="form-label" style="font-weight: bold;">{{ __('messages.Description/Details') }}</label>
                    <textarea class="form-control form-control-lg border-dark" id="description" name="description"
                              rows="3">{{ $receipt->description }}</textarea>
                </div>
            </div>
        </div>

        <!-- Footer يحتوي على زر الحفظ -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Close') }}</button>
            <button type="submit" class="btn btn-primary"
                    style="background-color: #0d6efd; border-radius: 50px; padding: 10px 20px;">{{ __('messages.Update Receipt') }}
            </button>
        </div>
    </form>




    <script>
        $(document).ready(function () {
            // تفعيل Select2 على قائمة اختيار المرضى
            $('#patient_id').select2({
                placeholder: 'ابحث عن اسم المريض',
                allowClear: true,
                width: '100%' // لضمان التوافق الكامل مع عرض العنصر
            });
        });
    </script>
    <script>
        document.getElementById('searchPatient').addEventListener('keyup', function () {
            var searchValue = this.value.toLowerCase();
            var options = document.getElementById('patient_id').options;

            for (var i = 0; i < options.length; i++) {
                var optionText = options[i].text.toLowerCase();
                if (optionText.includes(searchValue)) {
                    options[i].style.display = 'block';
                } else {
                    options[i].style.display = 'none';
                }
            }
        });
    </script>
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
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('Dashboard/js/table-data.js')}}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection

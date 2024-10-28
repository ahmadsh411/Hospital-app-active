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
                <h4 class="content-title mb-0 my-auto">Pages</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
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
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <!-- عنوان البطاقة -->
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">معلومات الدكتور</h3>
            <a href="{{ route('doctor.dashboard') }}" class="btn btn-light btn-sm">
                <i class="fas fa-arrow-left"></i> رجوع
            </a>
        </div>

        <!-- محتوى البطاقة -->
        <div class="card-body">
            <div class="text-center mb-4">
                @if($doctor->image)
                <img src="{{ asset('Dashboard/img/doctors/'.'/'.$doctor->image->filename) }}" alt="الصورة الحالية" class="img-thumbnail mb-3" style="width: 150px; height: 150px;">
                @else
                <i class="fas fa-user-md fa-5x text-primary mb-3"></i>
                @endif
                <h4 class="card-title">{{ $doctor->email }}</h4>

                <!-- زر الحالة مع وميض -->
                <span
                    class="badge badge-lg px-4 py-2 text-white {{ $doctor->status ? 'bg-success status-badge' : 'bg-danger status-badge' }}">
                    {{ $doctor->status ? 'نشط' : 'غير نشط' }}
                </span>
            </div>

            <!-- الجدول لتفاصيل الدكتور -->
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th><i class="fas fa-id-badge"></i>  الدكتور:</th>
                        <td>{{ $doctor->name }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-envelope"></i> البريد الإلكتروني:</th>
                        <td>{{ $doctor->email }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-phone-alt"></i> رقم الهاتف:</th>
                        <td>{{ $doctor->phone_number }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-clinic-medical"></i> القسم:</th>
                        <td>{{ $doctor->section->name }}</td>
                    </tr>
                    <tr>
                        <th><i class="fas fa-calendar-alt"></i> تاريخ الإنشاء:</th>
                        <td>{{ $doctor->created_at->format('Y-m-d H:i') }}</td>
                    </tr>


                    <tr>
                        <th><i class="fas fa-edit"></i> آخر تحديث:</th>
                        <td>{{ $doctor->updated_at->format('Y-m-d H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- زر العودة أسفل البطاقة -->
        <div class="card-footer text-center">
            <a href="{{ route('doctor.profile.edit') }}" class="btn btn-primary">
                <i class="fas fa-list"></i> تعديل البروفايل
            </a>
        </div>
    </div>
</div>

<!-- تأثير CSS للوميض -->
<style>
    .status-badge {
        animation: blink 1s infinite;
    }

    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }
</style>
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


    {{--    //select all--}}
    <script>
        $(function () {
            jQuery("[name=select_all]").click(function (source) {
                checkboxes = jQuery("[name=delete_select]");
                for (var i in checkboxes) {
                    checkboxes[i].checked = source.target.checked;
                }
            });
        })
    </script>


    <script type="text/javascript">
        $(function () {
            $("#btn_delete_all").click(function () {
                var selected = [];
                $("#example input[name=delete_select]:checked").each(function () {
                    selected.push(this.value);
                });

                if (selected.length > 0) {
                    $('#delete_select').modal('show')
                    $('input[id="delete_select_id"]').val(selected);
                }
            });
        });
    </script>

@endsection

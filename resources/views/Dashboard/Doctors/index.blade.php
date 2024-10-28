@extends('Dashboard.layouts.Admin.master')
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
    @php
        $i=1;
    @endphp
    @include('Dashboard.messages_allert')
    <button type="button" class="btn btn-primary" onclick="func1()">
        Create Doctor
    </button>
    <button type="button" class="btn btn-danger" id="btn_delete_all">{{trans('doctors.delete_select')}}</button>
    </div>
    <script>
        function func1() {
            window.location.href = ('{{route('doctor.create')}}')
        }
    </script>
    <br>
    <br>


    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mg-b-0">Bordered Table</h4>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2">Example of Valex Bordered Table.. <a href="">Learn more</a></p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">
                                    <div class="row">
                                        <div class="col-md-11">
                                            Image
                                        </div>
                                        <div class="col-md-1">
                                            <input name="select_all" id="example-select-all" type="checkbox"
                                                   title="selected to delete all doctors"/>
                                        </div>

                                    </div>
                                </th>

                                <th class="border-bottom-0">Doctor Name</th>
                                <th class="border-bottom-0">Email</th>
                                <th class="border-bottom-0">Section Name</th>
                                <th class="border-bottom-0">Activation</th>
                                <th class="border-bottom-0">Appointments</th>
                                <th class="border-bottom-0">Phone Number</th>
                                <th class="border-bottom-0">Operations</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <td>{{$i++}} </td>
                                    @if($doctor->image)
                                        <td>
                                            <input type="checkbox" name="delete_select" value="{{$doctor->id}}"
                                                   class="delete_select">
                                            <img src="{{asset('Dashboard/img/doctors/'.$doctor->image->filename)}}"
                                                 style="width: 50px ; border-radius:50%;height: 50px">
                                        </td>
                                    @else
                                        <td>
                                            <input type="checkbox" name="delete_select" value="{{$doctor->id}}"
                                                   class="delete_select">
                                            <img src="{{asset('Dashboard/img/doctors/Doctors_For_Men.avif')}}"
                                                 style="width: 50px ; border-radius:50%;height: 50px"/>
                                        </td>
                                    @endif
                                    <td>{{$doctor->name}}</td>
                                    <td>{{$doctor->email}}</td>
                                    <td>{{$doctor->section->name}}</td>
                                    <td>
                                        <div class="dot-label bg-{{$doctor->status == 1 ? 'success':'danger'}} ml-1"></div>
                                        {{$doctor->status == 1 ? "Enable":"Not Enable"}}
                                    </td>
                                    <td>
                                        {{ implode(', ', $doctor->appointments->pluck('name')->toArray()) }}
                                    </td>


                                    <td>{{$doctor->phone_number}}</td>

                                    <td>


                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                Operations
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <button type="button" class="btn btn-primary dropdown-item"
                                                        onclick="func2()">
                                                    <strong style="color: #0a7ffb"> Update Doctor Information</strong>
                                                </button>
                                                <script>
                                                    function func2() {
                                                        window.location.href = ('{{route('doctor.edit',['id'=>$doctor->id])}}');
                                                    }
                                                </script>

                                                <button type="button" class="btn btn-danger dropdown-item"
                                                        data-toggle="modal" data-target="#delete{{$doctor->id}}">
                                                    <strong style="color:red"> Delete The Doctor</strong>
                                                </button>
                                                <button type="button" class="btn btn-danger dropdown-item"
                                                        data-toggle="modal"
                                                        data-target="#update_password{{ $doctor->id }}">
                                                    <strong style="color:black"> Change Password</strong>
                                                </button>
                                                <button type="button" class="btn btn-danger dropdown-item"
                                                        data-toggle="modal"
                                                        data-target="#update_status{{ $doctor->id }}">
                                                    <strong style="color:lightseagreen"> Change Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @include('Dashboard.Doctors.delete')
                                @include('Dashboard.Doctors.update_password')
                                @include('Dashboard.Doctors.change_status')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
        @include('Dashboard.Doctors.delete_select')
        <!--div-->

        <!-- /row -->
    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
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

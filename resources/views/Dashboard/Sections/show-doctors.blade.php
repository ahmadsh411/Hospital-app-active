@extends('Dashboard.layouts.Admin.master')
@section('css')


@endsection

@section('title')
    {{$section->name}} / {{trans('sections_trans.section_doctors')}}
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{$section->name}}</h4><span
                        class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('sections_trans.section_doctors')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mg-b-0 text-md-nowrap table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{trans('doctors.name')}}</th>
                                <th>{{trans('doctors.email')}}</th>
                                <th>{{trans('doctors.section')}}</th>
                                <th>{{trans('doctors.phone')}}</th>
                                <th>{{trans('doctors.appointments')}}</th>
                                <th>{{trans('doctors.Status')}}</th>
                                <th>{{trans('doctors.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($section->doctors as $doctor)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$doctor->name}}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->section->name}}</td>
                                    <td>{{ $doctor->phone_number}}</td>
                                    <td>
                                        {{ implode(',',$doctor->appointments->pluck('name')->toArray()) }}
                                    </td>
                                    <td>
                                        <div
                                                class="dot-label bg-{{$doctor->status == 1 ? 'success':'danger'}} ml-1"></div>
                                        {{$doctor->status == 1 ? trans('doctors.Enabled'):trans('doctors.Not_enabled')}}
                                    </td>

                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown"
                                                    type="button">{{trans('doctors.Processes')}}<i
                                                        class="fas fa-caret-down mr-1"></i></button>
                                            <div class="dropdown-menu tx-13">
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
                    </div><!-- bd -->
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
@endsection

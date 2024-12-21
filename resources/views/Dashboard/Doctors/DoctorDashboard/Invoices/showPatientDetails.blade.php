@extends('Dashboard.layouts.Doctor.master_doctor')
@section('css')
    <style>
        /* الأنماط المشتركة للأزرار */
        .btn-edit, .btn-delete, .btn-link {
            display: inline-block; /* لجعل الـ <a> يبدو كزر */
            text-decoration: none; /* إزالة الخط السفلي الافتراضي للروابط */
            border: none;
            border-radius: 50px; /* زر دائري */
            padding: 10px 20px;
            color: white; /* لون النص */
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* ظل خفيف */
        }

        /* زر التعديل - أخضر بتدرج */
        .btn-edit, .btn-link-edit {
            background: linear-gradient(45deg, #28a745, #218838);
        }

        .btn-edit:hover, .btn-link-edit:hover {
            background: linear-gradient(45deg, #218838, #28a745); /* عكس التدرج عند التمرير */
            transform: translateY(-2px); /* يرتفع قليلاً */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* زيادة الظل */
        }

        /* زر الحذف - أحمر بتدرج */
        .btn-delete, .btn-link-delete {
            background: linear-gradient(45deg, #dc3545, #c82333);
            margin-left: 10px;
        }

        .btn-delete:hover, .btn-link-delete:hover {
            background: linear-gradient(45deg, #c82333, #dc3545); /* عكس التدرج عند التمرير */
            transform: translateY(-2px); /* يرتفع قليلاً */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* زيادة الظل */
        }
    </style>

@endsection
@section('title')
    معلومات المريض
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
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    @include('Dashboard.messages_allert')
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item">
                                                <a href="#tab1" class="nav-link active"
                                                   data-toggle="tab">{{ __('messages.patient_information') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#tab2" class="nav-link"
                                                   data-toggle="tab">{{ __('messages.invoices') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#tab3" class="nav-link"
                                                   data-toggle="tab">{{ __('messages.payments') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#tab4" class="nav-link"
                                                   data-toggle="tab">{{ __('messages.account_statement') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#tab5" class="nav-link"
                                                   data-toggle="tab">{{ __('messages.xray') }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#tab6" class="nav-link"
                                                   data-toggle="tab">{{ __('messages.laboratory') }}</a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">


                                        {{-- Strat Show Information Patient --}}

                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.patient_name') }}</th>
                                                        <th>{{ __('messages.phone_number') }}</th>
                                                        <th>{{ __('messages.email') }}</th>
                                                        <th>{{ __('messages.date_of_birth') }}</th>
                                                        <th>{{ __('messages.gender') }}</th>
                                                        <th>{{ __('messages.blood_type') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{ $patient->name }}</td>
                                                        <td>{{ $patient->phone }}</td>
                                                        <td>{{ $patient->email }}</td>
                                                        <td>{{ $patient->date_of_birth }}</td>
                                                        <td>{{ $patient->gender_id == 1 ? __('messages.male') : __('messages.female') }}</td>
                                                        <td>{{ $patient->bloodtype->type }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        {{-- End Show Information Patient --}}



                                        {{-- Start Invices Patient --}}

                                        <div class="tab-pane" id="tab2">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.service_name') }}</th>
                                                        <th>{{ __('messages.invoice_date') }}</th>
                                                        <th>{{ __('messages.total_with_tax') }}</th>
                                                        <th>{{ __('messages.invoice_type') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($invoices as $invoice)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            @if($invoice->service)
                                                                <td>{{ $invoice->service->name }}</td>
                                                            @else
                                                                <td>{{ $invoice->group->name }}</td>
                                                            @endif
                                                            <td>{{ $invoice->invoice_date }}</td>
                                                            <td>{{ $invoice->tot_with_tax }}</td>
                                                            <td>{{ $invoice->type == 1 ? __('messages.cash') : __('messages.credit') }}</td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="4" scope="row" class="alert alert-success">
                                                            {{ __('messages.total') }}
                                                        </th>
                                                        <td class="alert alert-primary">{{ number_format($invoices->sum('tot_with_tax'), 2) }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        {{-- End Invices Patient --}}



                                        {{-- Start Receipt Patient  --}}

                                        <div class="tab-pane" id="tab3">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.addition_date') }}</th>
                                                        <th>{{ __('messages.amount') }}</th>
                                                        <th>{{ __('messages.statement') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($receipt_accounts as $receipt_account)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $receipt_account->date }}</td>
                                                            <td>{{ $receipt_account->debit }}</td>
                                                            <td>{{ $receipt_account->description }}</td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th scope="row"
                                                            class="alert alert-success">{{ __('messages.total') }}</th>
                                                        <td colspan="4"
                                                            class="alert alert-primary">{{ number_format($receipt_accounts->sum('debit'), 2) }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        {{-- End Receipt Patient  --}}


                                        {{-- Start payment accounts Patient --}}
                                        <div class="tab-pane" id="tab4">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center"
                                                       id="example1">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.addition_date') }}</th>
                                                        <th>{{ __('messages.description') }}</th>
                                                        <th>{{ __('messages.debit') }}</th>
                                                        <th>{{ __('messages.credit') }}</th>
                                                        <th>{{ __('messages.final_balance') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($Patient_accounts as $Patient_account)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $Patient_account->date }}</td>
                                                            <td>
                                                                @if($Patient_account->single_invoice_id)
                                                                    {{ $Patient_account->singleInvoice->service->name }}
                                                                @elseif($Patient_account->receipt_id)
                                                                    {{ $Patient_account->receipt->description }}
                                                                @elseif($Patient_account->payment_id)
                                                                    {{ $Patient_account->payment->description }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $Patient_account->debit }}</td>
                                                            <td>{{ $Patient_account->credit }}</td>
                                                            <td>
                                                                {{-- حساب الرصيد النهائي يمكن إضافته هنا إذا كان مطلوباً --}}
                                                            </td>
                                                        </tr>
                                                        <br>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="3" scope="row"
                                                            class="alert alert-success">{{ __('messages.total') }}</th>
                                                        <td class="alert alert-primary">{{ number_format($debit = $Patient_accounts->sum('debit'), 2) }}</td>
                                                        <td class="alert alert-primary">{{ number_format($credit = $Patient_accounts->sum('credit'), 2) }}</td>
                                                        <td class="alert alert-danger">
                    <span class="text-danger">
                        {{ $debit - $credit }} {{ $debit - $credit > 0 ? __('messages.debtor') : __('messages.creditor') }}
                    </span>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <br>
                                        </div>


                                        {{-- End payment accounts Patient --}}
                                        {{--                                               trans--}}

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center" id="example1">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.doctor_name') }}</th>
                                                        <th>{{ __('messages.patient_name') }}</th>
                                                        <th>{{ __('messages.service_or_group_name') }}</th>
                                                        <th>{{ __('messages.description') }}</th>
                                                        <th>{{ __('messages.image') }}</th>
                                                        <th>{{ __('messages.operations') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($patientRays as $patientRay)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $patientRay->doctor->name }}</td>
                                                            <td>{{ $patientRay->patient->name }}</td>
                                                            <td>
                                                                @if(isset($patientRay->invoice->service))
                                                                    {{ $patientRay->invoice->service->name }}
                                                                @elseif(isset($patientRay->invoice->group))
                                                                    {{ $patientRay->invoice->group->name }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $patientRay->description }}</td>

                                                            <!-- عرض جميع الصور المرتبطة بالشعاع -->
                                                            <td>
                                                                @if($patientRay->images->count() > 0)
                                                                    @foreach($patientRay->images as $image)
                                                                        @if($image->type == 0)
                                                                            <img src="{{ asset('Dashboard/img/x-rays/'.$patientRay->patient->name.'/send/'.$patientRay->id.'/'.$image->filename) }}"
                                                                                 style="width: 150px; border-radius: 10%; height: 80px; margin-right: 10px;">
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <span>{{ __('messages.no_images') }}</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($patientRay->doctor->id == auth('doctor')->user()->id)
                                                                    @if($patientRay->status == 0)
                                                                        <a href="{{ route('rays.edit', ['id' => $patientRay->id]) }}" class="btn-edit">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    @else
                                                                        <a href="{{ route('rays.show', $patientRay->id) }}" class="btn-edit">
                                                                            <i class="fas fa-eye"></i>
                                                                        </a>
                                                                    @endif
                                                                    <button type="button" class="btn-delete btn btn-danger" data-target="#deleteRay{{ $patientRay->id }}" data-toggle="modal" style="border-radius: 50px; transition: 0.3s;">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                @else
                                                                    {{ __('messages.cannot_edit') }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <br>
                                                        @include('Dashboard.Doctors.DoctorDashboard.Invoices.delete')
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="tab6">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center" id="example1">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>{{ __('messages.doctor_name') }}</th>
                                                        <th>{{ __('messages.patient_name') }}</th>
                                                        <th>{{ __('messages.service_or_group_name') }}</th>
                                                        <th>{{ __('messages.description') }}</th>
                                                        <th>{{ __('messages.image') }}</th>
                                                        <th>{{ __('messages.operations') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($patientLaboratories as $patientLaboratory)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $patientLaboratory->doctor->name }}</td>
                                                            <td>{{ $patientLaboratory->patient->name }}</td>
                                                            <td>
                                                                @if(isset($patientLaboratory->invoice->service))
                                                                    {{ $patientLaboratory->invoice->service->name }}
                                                                @elseif(isset($patientLaboratory->invoice->group))
                                                                    {{ $patientLaboratory->invoice->group->name }}
                                                                @endif
                                                            </td>
                                                            <td>{{ $patientLaboratory->description }}</td>

                                                            <!-- عرض جميع الصور المرتبطة بالمختبر -->
                                                            <td>
                                                                @if($patientLaboratory->images)
                                                                    @foreach($patientLaboratory->images as $image)
                                                                        @if($image->type == 0)
                                                                            <img src="{{ asset('Dashboard/img/Laboratory/Send/'.$patientLaboratory->patient->name.'/'.$patientLaboratory->id.'/'.$image->filename) }}"
                                                                                 style="width: 100px; margin-right: 10px;">
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <span>{{ __('messages.no_images') }}</span>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if($patientLaboratory->doctor->id == auth('doctor')->user()->id)
                                                                    @if($patientLaboratory->status == 1)
                                                                        <a href="#" class="btn-edit"><i class="fas fa-eye"></i></a>
                                                                    @else
                                                                        <a href="{{ route('laboratories.edit', ['laboratory' => $patientLaboratory->id]) }}" class="btn-edit">
                                                                            <i class="fas fa-edit"></i>
                                                                        </a>
                                                                    @endif
                                                                    <button type="button" class="btn-delete btn btn-danger" data-target="#deleteLaboratory{{ $patientLaboratory->id }}" data-toggle="modal" style="border-radius: 50px; transition: 0.3s;">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                @else
                                                                    {{ __('messages.cannot_edit') }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @include('Dashboard.Doctors.DoctorDashboard.Invoices.Laboratory.delete')
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Prism Precode -->
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
@endsection


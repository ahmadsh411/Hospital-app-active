@extends('Dashboard.layouts.Doctor.master_doctor')
@section('css')
    <link href="{{URL::asset('Dashboard/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('Dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom Styles -->
    <style>
        /* Global Styles */
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f5f6fa;
        }

        .diagnosis-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .diagnosis-card {
            border-left: 5px solid;
            border-radius: 15px;
            background: white;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .diagnosis-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .diagnosis-card .card-title {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .diagnosis-card p {
            font-size: 1.2rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .diagnosis-card p i {
            margin-right: 10px;
            font-size: 1.3rem;
        }

        /* Custom section colors */
        .diagnosis-card .date-section {
            background-color: #3498db;
            padding: 10px;
            border-radius: 10px;
            color: white;
            margin-bottom: 10px;
        }

        .diagnosis-card .patient-section {
            background-color: #e74c3c;
            padding: 10px;
            border-radius: 10px;
            color: white;
            margin-bottom: 10px;
        }

        .diagnosis-card .doctor-section {
            background-color: #1abc9c;
            padding: 10px;
            border-radius: 10px;
            color: white;
            margin-bottom: 10px;
        }

        .diagnosis-card .diagnosis-section {
            background-color: #f39c12;
            padding: 10px;
            border-radius: 10px;
            color: white;
            margin-bottom: 10px;
        }

        .diagnosis-card .medicals-section {
            background-color: #9b59b6;
            padding: 10px;
            border-radius: 10px;
            color: white;
            margin-bottom: 10px;
        }

        /* Alert for no data */
        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border-color: #bee5eb;
            font-size: 1.2rem;
            padding: 15px;
        }

        .alert-info .fas {
            color: #0c5460;
        }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('messages.patient_diagnoses') }}</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('messages.medications_and_diagnoses') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <div class="container">
        <h2 class="text-center"><i class="fas fa-notes-medical"></i> {{ __('messages.diagnoses_and_medications') }}</h2>

        @if($medicals->isEmpty())
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i> {{ __('messages.no_diagnoses_for_patient') }}
            </div>
        @else
            <div class="diagnosis-container">
                @foreach($medicals as $medical)
                    <div class="diagnosis-card">
                        <div class="card-body">
                            <h5 class="card-title date-section"><i class="fas fa-calendar-alt"></i> {{ $medical->date }}
                            </h5>
                            <p class="card-text patient-section"><i class="fas fa-user"></i>
                                {{ __('messages.patient') }}: {{ $medical->patient->name }}</p>
                            <p class="card-text doctor-section"><i class="fas fa-user-md"></i>
                                {{ __('messages.treating_doctor') }}: {{ $medical->doctor->name }}</p>
                            <p class="card-text diagnosis-section"><i class="fas fa-stethoscope"></i>
                                {{ __('messages.diagnosis') }}: {{ $medical->translate('ar')->diagnoses_notes }}</p>
                            <p class="card-text medicals-section"><i class="fas fa-pills"></i>
                                {{ __('messages.medications') }}: {{ $medical->medicals }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('js')
    <!-- Internal Notify js -->
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('Dashboard/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection

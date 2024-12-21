<!-- Modal -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="addPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addPatientLabel">{{ __('patients.add_title') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('buttons.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('patient-hospital.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">{{ __('patients.patient_name') }}:</label>
                            <input type="text" name="name" placeholder="{{ __('patients.placeholder_patient_name') }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="id_number">{{ __('patients.id_number') }}:</label>
                            <input type="text" name="id_number" placeholder="{{ __('patients.placeholder_id_number') }}" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email">{{ __('patients.email') }}:</label>
                            <input type="email" name="email" placeholder="{{ __('patients.placeholder_email') }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="phone">{{ __('patients.phone_number') }}:</label>
                            <input type="text" name="phone" placeholder="{{ __('patients.placeholder_phone') }}" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="address">{{ __('patients.address') }}:</label>
                            <input type="text" name="address" placeholder="{{ __('patients.placeholder_address') }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_birth">{{ __('patients.date_of_birth') }}:</label>
                            <input type="date" name="date_of_birth" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="gender_id">{{ __('patients.gender') }}:</label>
                            <select name="gender_id" class="form-control" required>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->gender_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="blood_id">{{ __('patients.blood_type') }}:</label>
                            <select name="blood_id" class="form-control" required>
                                @foreach($blood_types as $blood)
                                    <option value="{{ $blood->id }}">{{ $blood->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('insurance.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('patients.add_patient') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

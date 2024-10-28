<!-- Modal -->
<div class="modal fade" id="update{{ $patient->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content animate__animated animate__fadeInDown">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalLabel">Update Patient Information</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('patient-hospital.update', ['patient_hospital' => $patient->id]) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Patient Name:</label>
                            <input type="text" name="name" value="{{ $patient->name }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="id_number">ID Number:</label>
                            <input type="text" name="id_number" value="{{ $patient->id_number }}" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" name="email" value="{{ $patient->email }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="phone">Phone Number:</label>
                            <input type="text" name="phone" value="{{ $patient->phone }}" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="address">Address:</label>
                            <input type="text" name="address" value="{{ $patient->address }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_birth">Date of Birth:</label>
                            <input type="date" name="date_of_birth" value="{{ $patient->date_of_birth }}" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="gender_id">Gender:</label>
                            <select name="gender_id" class="form-control" required>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}" {{ $gender->id == $patient->gender_id ? 'selected' : '' }}>{{ $gender->gender_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="blood_id">Blood Type:</label>
                            <select name="blood_id" class="form-control" required>
                                @foreach($blood_types as $blood)
                                    <option value="{{ $blood->id }}" {{ $blood->id == $patient->blood_id ? 'selected' : '' }}>{{ $blood->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>

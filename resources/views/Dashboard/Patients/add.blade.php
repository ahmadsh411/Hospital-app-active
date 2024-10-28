<!-- Modal -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add New Patient</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('patient-hospital.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Patient Name:</label>
                            <input type="text" name="name" placeholder="Enter Patient's Name" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="id_number">ID Number:</label>
                            <input type="text" name="id_number" placeholder="Enter ID Number" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="email">Email:</label>
                            <input type="email" name="email" placeholder="Enter Email" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="phone">Phone Number:</label>
                            <input type="text" name="phone" placeholder="Enter Phone Number" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="address">Address:</label>
                            <input type="text" name="address" placeholder="Enter Address" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_birth">Date of Birth:</label>
                            <input type="date" name="date_of_birth" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="gender_id">Gender:</label>
                            <select name="gender_id" class="form-control" required>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->gender_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="blood_id">Blood Type:</label>
                            <select name="blood_id" class="form-control" required>
                                @foreach($blood_types as $blood)
                                    <option value="{{ $blood->id }}">{{ $blood->type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>


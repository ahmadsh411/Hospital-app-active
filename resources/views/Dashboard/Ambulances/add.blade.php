<!-- Modal -->
<div class="modal fade" id="addAmbulance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add New Ambulance</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('ambulance-hospital.store')}}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="driver_name">Driver Name:</label>
                            <input type="text" name="driver_name" placeholder="Enter Driver's Name" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label for="car_number">Car Number:</label>
                            <input type="text" name="car_number" placeholder="Enter Car Number" class="form-control" required/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="car_model">Car Model:</label>
                            <input type="text" name="car_model" placeholder="Enter Car Model" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_manufacture">Date of Manufacture:</label>
                            <input type="text" name="date_of_manufacture" class="form-control" required/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="license_number">License Number:</label>
                            <input type="text" name="license_number" placeholder="Enter License Number" class="form-control" required/>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" name="phone_number" placeholder="Enter Phone Number" class="form-control" required/>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="type">Type:</label>
                            <select name="type" class="form-control">
                                <option value="0">Owned</option>
                                <option value="1">Rent</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="notes">Notes:</label>
                            <textarea name="notes" rows="3" placeholder="Enter Notes" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Ambulance</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal: Add Insurance -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- لجعل النافذة أكبر -->
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add New Insurance</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('insurance-company.store') }}" method="POST" autocomplete="off">
                <div class="modal-body p-4">
                    @csrf
                    <div class="row">
                        <!-- Company Name -->
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Company Name:</label>
                            <input type="text" name="name" id="company_name" class="form-control" placeholder="Enter Company Name" required>
                        </div>
                        <!-- Company Code -->
                        <div class="col-md-6 mb-3">
                            <label for="company_code" class="form-label">Company Code:</label>
                            <input type="text" name="code" id="company_code" class="form-control" placeholder="Enter Company Code" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Company Email -->
                        <div class="col-md-6 mb-3">
                            <label for="company_email" class="form-label">Company Email:</label>
                            <input type="email" name="email" id="company_email" class="form-control" placeholder="Enter Company Email" required>
                        </div>
                        <!-- Company Rate -->
                        <div class="col-md-6 mb-3">
                            <label for="company_rate" class="form-label">Company Rate:</label>
                            <input type="number" step="0.01" name="company_rate" id="company_rate" class="form-control" placeholder="Enter Company Rate" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Patient Tolerance -->
                        <div class="col-md-6 mb-3">
                            <label for="patient_tolerance" class="form-label">Patient Tolerance:</label>
                            <input type="number" name="patient_tolerance" id="patient_tolerance" class="form-control" placeholder="Enter Patient Tolerance" required>
                        </div>
                        <!-- Status -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes:</label>
                        <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="Enter any notes"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Insurance</button>
                </div>
            </form>
        </div>
    </div>
</div>

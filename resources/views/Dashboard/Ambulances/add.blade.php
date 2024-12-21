<div class="modal fade" id="addAmbulance" tabindex="-1" role="dialog" aria-labelledby="addAmbulanceLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addAmbulanceLabel">{{ __('ambulance.add_title') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('buttons.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ambulance-hospital.store') }}" method="POST" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="driver_name">{{ __('ambulance.driver_name') }}:</label>
                            <input type="text" name="driver_name" placeholder="{{ __('ambulance.placeholder_driver_name') }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="car_number">{{ __('ambulance.car_number') }}:</label>
                            <input type="text" name="car_number" placeholder="{{ __('ambulance.placeholder_car_number') }}" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="car_model">{{ __('ambulance.car_model') }}:</label>
                            <input type="text" name="car_model" placeholder="{{ __('ambulance.placeholder_car_model') }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_manufacture">{{ __('ambulance.date_of_manufacture') }}:</label>
                            <input type="text" name="date_of_manufacture" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="license_number">{{ __('ambulance.license_number') }}:</label>
                            <input type="text" name="license_number" placeholder="{{ __('ambulance.placeholder_license_number') }}" class="form-control" required />
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number">{{ __('ambulance.phone_number') }}:</label>
                            <input type="text" name="phone_number" placeholder="{{ __('ambulance.placeholder_phone_number') }}" class="form-control" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="type">{{ __('ambulance.type') }}:</label>
                            <select name="type" class="form-control">
                                <option value="0">{{ __('ambulance.owned') }}</option>
                                <option value="1">{{ __('ambulance.rent') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="notes">{{ __('ambulance.notes') }}:</label>
                            <textarea name="notes" rows="3" placeholder="{{ __('ambulance.placeholder_notes') }}" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('ambulance.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('ambulance.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Update Ambulance Modal -->
<div class="modal fade" id="updateAmbulance{{$ambulance->id}}" tabindex="-1" role="dialog" aria-labelledby="updateAmbulanceLabel{{$ambulance->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg animate__animated animate__fadeInDown" role="document">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="updateAmbulanceLabel{{$ambulance->id}}">
                    {{ __('ambulance.update_title', ['car_number' => $ambulance->car_number]) }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('buttons.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ambulance-hospital.update', ['ambulance_hospital' => $ambulance->id]) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="driver_name">{{ __('ambulance.driver_name') }}:</label>
                            <input type="text" name="driver_name" value="{{ $ambulance->name }}" class="form-control border border-info shadow-sm" required />
                        </div>
                        <div class="col-md-6">
                            <label for="car_number">{{ __('ambulance.car_number') }}:</label>
                            <input type="text" name="car_number" value="{{ $ambulance->car_number }}" class="form-control border border-info shadow-sm" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="car_model">{{ __('ambulance.car_model') }}:</label>
                            <input type="text" name="car_model" value="{{ $ambulance->car_model }}" class="form-control border border-info shadow-sm" required />
                        </div>
                        <div class="col-md-6">
                            <label for="date_of_manufacture">{{ __('ambulance.date_of_manufacture') }}:</label>
                            <input type="text" name="date_of_manufacture" value="{{ $ambulance->date_of_manufacture }}" class="form-control border border-info shadow-sm" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="license_number">{{ __('ambulance.license_number') }}:</label>
                            <input type="text" name="license_number" value="{{ $ambulance->license_number }}" class="form-control border border-info shadow-sm" required />
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number">{{ __('ambulance.phone_number') }}:</label>
                            <input type="text" name="phone_number" value="{{ $ambulance->phone_number }}" class="form-control border border-info shadow-sm" required />
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="type">{{ __('ambulance.type') }}:</label>
                            <select name="type" class="form-control border border-info shadow-sm">
                                <option value="0" {{ $ambulance->type == 0 ? 'selected' : '' }}>{{ __('statuses.owned') }}</option>
                                <option value="1" {{ $ambulance->type == 1 ? 'selected' : '' }}>{{ __('statuses.rent') }}</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="notes">{{ __('ambulance.notes') }}:</label>
                            <textarea name="notes" class="form-control border border-info shadow-sm" rows="3">{{ $ambulance->notes }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('ambulance.close') }}</button>
                    <button type="submit" class="btn btn-outline-success btn-lg">
                        {{ __('ambulance.update') }} <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

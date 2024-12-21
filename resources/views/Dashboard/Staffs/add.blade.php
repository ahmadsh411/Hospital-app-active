<!-- Modal for Adding New Staff -->
<div class="modal fade" id="addstaff" tabindex="-1" role="dialog" aria-labelledby="addStaffModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
            <div class="modal-header" style="background-color: #007bff; color: white;">
                <h5 class="modal-title" id="addStaffModal">{{ __('messages.Add New Staff Member') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color: white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('staff-hospital.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">{{ __('messages.Name') }}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('messages.Enter staff name') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">{{ __('messages.Email') }}</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('messages.Enter staff email') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">{{ __('messages.Password') }}</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('messages.Enter password') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="address">{{ __('messages.Address') }}</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="{{ __('messages.Enter staff address') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">{{ __('messages.Phone') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="{{ __('messages.Enter staff phone') }}" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender_id">{{ __('messages.Gender') }}</label>
                                <select class="form-control select2" id="gender_id" name="gender_id" required>
                                    @foreach($genders as $gender)
                                        <option value="{{ $gender->id }}">{{ $gender->gender_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="section_id">{{ __('messages.Section') }}</label>
                                <select class="form-control select2" id="section_id" name="section_id" required>
                                    @foreach($sections as $section)
                                        <option value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="appointment_id">{{ __('messages.Appointment') }}</label>
                                <select class="form-control select2" id="appointment_id" name="appointment_ids[]" multiple="multiple" required>
                                    @foreach($appointments as $appointment)
                                        <option value="{{ $appointment->id }}">{{ $appointment->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('messages.Add Staff Member') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Select2 JavaScript (to enable multiple selections with a nice UI) -->
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "{{ __('messages.Select options') }}",
            allowClear: true,
            width: '100%',
        });
    });
</script>

<!-- Optional: You can add smooth fade-in effect for the modal -->
<script>
    $('#addstaff').on('show.bs.modal', function () {
        $(this).find('.modal-content').css({
            opacity: 0,
            transition: 'opacity 0.3s ease'
        }).animate({
            opacity: 1
        }, 300);
    });
</script>

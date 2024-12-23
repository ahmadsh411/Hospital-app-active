<div class="modal fade" id="addDiagnosisModal{{$invoice->patient->id}}" tabindex="-1" role="dialog" aria-labelledby="addDiagnosisModalLabel{{$invoice->patient->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDiagnosisModalLabel{{$invoice->patient->id}}">
                    {{ __('messages.add_diagnosis_for', ['name' => $invoice->patient->name]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('messages.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- نموذج إضافة التشخيص -->
                <form action="{{ route('medicals.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="diagnosis">{{ __('messages.diagnosis') }}</label>
                        <textarea class="form-control" id="diagnosis" name="diagnoses" rows="3" required placeholder="{{ __('messages.enter_diagnosis') }}"></textarea>
                    </div>
                    <input type="hidden" value="{{ $invoice->patient->id }}" name="patient_id">
                    <input type="hidden" value="{{ $invoice->doctor->id }}" name="doctor_id">
                    <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
                    <div class="form-group">
                        <label for="notes">{{ __('messages.medications') }}</label>
                        <textarea class="form-control" id="notes" name="medicals" rows="2" placeholder="{{ __('messages.enter_medications') }}"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('messages.save_diagnosis') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal لإضافة مراجعة -->
<div class="modal fade" id="addReview{{ $invoice->id }}" tabindex="-1" role="dialog" aria-labelledby="addReviewLabel{{ $invoice->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- جعل الميدولة أكبر قليلاً -->
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addReviewLabel{{ $invoice->id }}">
                    <i class="fas fa-notes-medical"></i> {{ __('messages.add_review') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('messages.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- نموذج المراجعة -->
                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="diagnosis">
                            <i class="fas fa-stethoscope"></i> {{ __('messages.diagnosis') }}
                        </label>
                        <textarea class="form-control" id="diagnosis" name="diagnoses" rows="3" required placeholder="{{ __('messages.enter_diagnosis') }}"></textarea>
                    </div>
                    <!-- حقول مخفية -->
                    <input type="hidden" value="{{ $invoice->patient->id }}" name="patient_id">
                    <input type="hidden" value="{{ $invoice->doctor->id }}" name="doctor_id">
                    <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
                    <div class="form-group">
                        <label for="medicals">
                            <i class="fas fa-pills"></i> {{ __('messages.medications') }}
                        </label>
                        <textarea class="form-control" id="medicals" name="medicals" rows="2" placeholder="{{ __('messages.enter_medications') }}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="review_date">
                            <i class="fas fa-calendar-alt"></i> {{ __('messages.next_review_date') }}
                        </label>
                        <input type="date" class="form-control" id="review_date" name="review_date" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> {{ __('messages.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('messages.save_diagnosis') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

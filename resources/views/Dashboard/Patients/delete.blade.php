<!-- Delete Modal -->
<div class="modal fade" id="delete{{ $patient->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $patient->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{ $patient->id }}">
                    {{ __('patients.delete_title') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('buttons.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('patient-hospital.destroy', ['patient_hospital' => $patient->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>
                        {{ __('patients.delete_confirmation', ['name' => $patient->name]) }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('insurance.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ __('insurance.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

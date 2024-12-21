<!-- Modal for Deletion -->
<div class="modal fade" id="deleteRay{{$patientRay->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">
                    {{ __('messages.confirm_deletion_for') }} {{ $patientRay->description }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('messages.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p style="font-size: 18px; font-weight: bold;">
                    {{ __('messages.are_you_sure_delete_ray') }}
                </p>
                <i class="fas fa-exclamation-triangle fa-5x text-warning mb-3 animate__animated animate__tada"></i>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="border-radius: 30px; padding: 10px 20px;">
                    {{ __('messages.cancel') }}
                </button>

                <!-- Confirm Delete Button -->
                <form method="POST" action="{{ route('rays.delete', ['id' => $patientRay->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" style="border-radius: 30px; padding: 10px 20px;">
                        {{ __('messages.delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include animate.css library for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

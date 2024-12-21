<!-- Delete Ambulance Modal -->
<div class="modal fade" id="delete{{$ambulance->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$ambulance->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Header للمودال -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{$ambulance->id}}">
                    {{ __('ambulance.delete_title', ['car_number' => $ambulance->car_number]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('ambulance.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body للمودال -->
            <form action="{{ route('ambulance-hospital.destroy', ['ambulance_hospital' => $ambulance->id]) }}" method="POST" autocomplete="off">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p class="font-weight-bold text-center">
                        {{ __('ambulance.delete_confirmation') }}
                    </p>
                </div>

                <!-- Footer للمودال -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('ambulance.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ __('ambulance.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

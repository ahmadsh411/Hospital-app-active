<!-- Modal -->
<div class="modal fade" id="delete{{$ambulance->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$ambulance->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Header للمودال -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel{{$ambulance->id}}">
                    Delete Ambulance: {{ $ambulance->car_number }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body للمودال -->
            <form action="{{ route('ambulance-hospital.destroy', ['ambulance_hospital' => $ambulance->id]) }}" method="POST" autocomplete="off">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p class="font-weight-bold text-center">
                        Are you sure you want to delete this ambulance? This action cannot be undone.
                    </p>
                </div>

                <!-- Footer للمودال -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

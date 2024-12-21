<!-- Modal -->
<div class="modal fade" id="update_status{{ $doctor->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('doctors.status_change') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('common.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('doctor.changestatus', ['id' => $doctor->id]) }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="status">{{ trans('doctors.status') }}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" selected disabled>--{{ trans('doctors.changestatus') }}--</option>
                            <option value="1">{{ trans('doctors.enabled') }}</option>
                            <option value="0">{{ trans('doctors.not_enabled') }}</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="{{ $doctor->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('common.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('common.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

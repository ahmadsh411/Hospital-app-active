<!-- Modal -->
<div class="modal fade" id="update_password{{ $doctor->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('doctors.update_password_for', ['name' => $doctor->name]) }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('common.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('chang.passowrd', ['id' => $doctor->id]) }}" method="POST" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">{{ trans('doctors.new_password') }}</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">{{ trans('doctors.confirm_password') }}</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>

                    <input type="hidden" name="id" value="{{ $doctor->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('doctor.close') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ trans('doctors.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

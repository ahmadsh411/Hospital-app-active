<!-- Modal -->
<div class="modal fade" id="delete_select" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('doctors.delete_selected') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('common.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('doctor.destroy')}}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>{{ trans('doctors.confirm_delete_selected') }}</h5>
                    <input type="hidden" id="delete_select_id" name="delete_select_id" value=''>
                    <input type="hidden" name="page_id" value='2'>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('doctors.close') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                        {{ trans('doctors.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

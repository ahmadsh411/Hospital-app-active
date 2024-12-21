<!-- Modal -->
<div class="modal fade" id="delete{{$doctor->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('doctors.delete_doctor') }}: {{$doctor->name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('common.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('doctor.destroy')}}" method="POST" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <div>
                        <h3 style="color: red">{{ trans('doctors.confirm_delete') }}</h3>
                        <input type="hidden" name="page_id" value="1"/>
                        <input type="hidden" name="id" value="{{$doctor->id}}"/>
                        @if($doctor->image)
                            <input type="hidden" value="{{$doctor->image->filename}}" name="image"/>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ trans('doctors.close') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ trans('doctors.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

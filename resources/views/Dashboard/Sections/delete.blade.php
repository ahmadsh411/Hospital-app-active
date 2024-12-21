<!-- Modal -->
<div class="modal fade" id="delete{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('dashboard.delete_section') }}: {{$section->name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('dashboard.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('section.delete', ['id' => $section->id]) }}" method="POST" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <div>
                        <h3 style="color: red">{{ __('dashboard.confirm_delete_section') }}</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('dashboard.delete') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

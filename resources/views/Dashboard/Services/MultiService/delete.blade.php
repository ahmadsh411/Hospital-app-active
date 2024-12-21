<!-- Modal -->
<div class="modal fade" id="delete{{$service->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('messages.delete_section') }}: {{$service->name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('messages.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form -->
            <form action="{{ route('multi-services.destroy', 'test') }}" method="POST" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <div>
                        <h3 style="color: red">{{ __('messages.confirm_delete_service') }}</h3>
                        <input type="hidden" name="id" value="{{$service->id}}">
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('messages.close') }}
                    </button>
                    <button type="submit" class="btn btn-primary">
                        {{ __('messages.delete') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

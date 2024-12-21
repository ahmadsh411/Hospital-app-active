<!-- Modal -->
<div class="modal fade" id="update{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('dashboard.update_section') }}: {{$section->name}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('dashboard.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('section.update', ['id' => $section->id]) }}" method="POST" autocomplete="off">
                <div class="modal-body">
                    @csrf

                    <label>{{ __('dashboard.section_name') }}:</label>
                    <input type="text" name="name" placeholder="{{ __('dashboard.enter_section_name') }}" class="form-control" value="{{ $section->name }}"/>
                    <label>{{ __('dashboard.description') }}:</label>
                    <textarea class="form-control" name="description">{{$section->description}}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('dashboard.done') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.add_section') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('dashboard.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('section.store') }}" method="POST" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    <label>{{ __('dashboard.section_name') }}:</label>
                    <input type="text" name="name" placeholder="{{ __('dashboard.enter_section_name') }}" class="form-control"/>

                    <label>{{ __('dashboard.description') }}:</label>
                    <textarea cols="3" name="description" class="form-control" placeholder="{{ __('dashboard.enter_description') }}"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('dashboard.done') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

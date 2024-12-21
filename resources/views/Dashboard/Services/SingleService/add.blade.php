<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('dashboard.add_service')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('dashboard.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('services.store')}}" method="POST" autocomplete="off">
            <div class="modal-body">
                @csrf
                <label>@lang('dashboard.service_name'):</label>
                <input type="text" name="name" placeholder="@lang('dashboard.enter_service_name')" class="form-control"/>
                <br>
                <label>@lang('dashboard.service_price'):</label>
                <input type="text" name="price" placeholder="@lang('dashboard.enter_service_price')" class="form-control"/>
                <br>
                <label>@lang('dashboard.description'):</label>
                <textarea cols="10" name="description" class="form-control" placeholder="@lang('dashboard.enter_description')"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('dashboard.close')</button>
                <button type="submit" class="btn btn-primary">@lang('dashboard.done')</button>
            </div>
            </form>
        </div>
    </div>
</div>

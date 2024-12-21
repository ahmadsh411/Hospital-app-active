<!-- Modal -->
<div class="modal fade" id="update{{$single->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    @lang('dashboard.update_service', ['service' => $single->name])
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="@lang('dashboard.close')">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('services.update','test')}}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <label>@lang('dashboard.service_name'):</label>
                    <input type="text" name="name" value="{{$single->name}}" class="form-control"/>
                    <input type="hidden" name="id" value="{{$single->id}}" class="form-control"/>
                    <br>
                    <label>@lang('dashboard.service_price'):</label>
                    <input type="text" name="price" value="{{$single->price}}" class="form-control"/>
                    <br>
                    <label>@lang('dashboard.description'):</label>
                    <textarea cols="10" name="description" class="form-control">{{$single->description}}</textarea>
                    <br>
                    <label>@lang('dashboard.status'):</label>
                    <select class="form-select" aria-label="Default select example" name="status">
                        <option value="3" disabled>
                            @if($single->status == 1)
                                @lang('dashboard.enabled')
                            @else
                                @lang('dashboard.not_enabled')
                            @endif
                        </option>
                        <option value="1">@lang('dashboard.enable')</option>
                        <option value="0">@lang('dashboard.not_enable')</option>
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        @lang('dashboard.close')
                    </button>
                    <button type="submit" class="btn btn-primary">@lang('dashboard.done')</button>
                </div>
            </form>
        </div>
    </div>
</div>

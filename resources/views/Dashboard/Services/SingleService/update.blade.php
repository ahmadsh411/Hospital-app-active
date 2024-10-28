<!-- Modal -->
<div class="modal fade" id="update{{$single->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Service:{{$single->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('services.update','test')}}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    @csrf
                    <label>Service Name:</label>
                    <input type="text" name="name" value="{{$single->name}}" class="form-control"/>
                    <input type="hidden" name="id" value="{{$single->id}}" class="form-control"/>
                    <br>
                    <label>Service Price:</label>
                    <input type="text" name="price" value="{{$single->price}}" class="form-control"/>
                    <label>Description:</label>
                    <textarea cols="10" name="description"  class="form-control">{{$single->description}}
                </textarea>
                    <select class="form-select" aria-label="Default select example" name="status">

                        <option value="3" disabled>{{$single->status==1?"Enable":"Not Enable"}}</option>
                        <option value="1">Enable</option>
                        <option value="0">Not Enable</option>

                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="update{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Section:{{$section->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('section.update',['id'=>$section->id])}}" method="POST" autocomplete="off">
                <div class="modal-body">
                    @csrf

                    <label>Section Name:</label>
                    <input type="text" name="name" placeholder="Enter The Section Name" class="form-control"/>
                      <p>{{$section->id}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Done</button>
                </div>
            </form>
        </div>
    </div>
</div>


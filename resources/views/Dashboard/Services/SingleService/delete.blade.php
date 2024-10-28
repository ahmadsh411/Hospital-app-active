<!-- Modal -->
<div class="modal fade" id="delete{{$single->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DeleteThe Section:{{$single->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('services.destroy','test')}}" method="POST" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                   <div>
                       <h3 style="color: red">Are You Shore To Delete The Service !</h3>
                       <input type="hidden" name="id" value="{{$single->id}}">
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>



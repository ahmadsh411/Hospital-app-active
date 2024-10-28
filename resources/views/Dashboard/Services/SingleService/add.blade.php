<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('services.store')}}" method="POST" autocomplete="off">
            <div class="modal-body">
                   @csrf
                  <label>Service Name:</label>
                  <input type="text" name="name" placeholder="Enter The Service Name" class="form-control"/>
                <br>
                <label>Service Price:</label>
                <input type="text" name="price" placeholder="Enter The Service Price" class="form-control"/>
                 <label>Description:</label>
                <textarea cols="10" name="description"  class="form-control">
                </textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Done</button>
            </div>
            </form>
        </div>
    </div>
</div>

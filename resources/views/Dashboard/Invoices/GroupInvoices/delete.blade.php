<!-- Modal: Delete Invoice -->
<div class="modal fade" id="deleteInvoice{{$singleInvoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Header Section -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Delete Invoice: {{$singleInvoice->patient->name}}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form Section -->
            <form action="{{route('group-invoices.destroy',['group_invoice'=>$singleInvoice->id])}}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        <h4>Are you sure you want to delete this Invoice? </h4>
                        <h3>{{$singleInvoice->multiservice->name}}</h3>
                        <p>This action cannot be undone.</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

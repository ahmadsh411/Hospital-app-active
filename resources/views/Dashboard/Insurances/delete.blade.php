<!-- Modal: Delete Insurance -->
<div class="modal fade" id="deleteInsuranceModal{{$insurance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Header Section -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">Delete Insurance: {{$insurance->company_name}}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form Section -->
            <form action="{{route('insurance-company.destroy', ['insurance_company' => $insurance->id])}}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        <h4>Are you sure you want to delete this insurance?</h4>
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

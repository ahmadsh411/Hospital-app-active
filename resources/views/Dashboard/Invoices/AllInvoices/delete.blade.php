<!-- Modal: Delete Invoice -->
<div class="modal fade" id="deleteInvoices{{$singleInvoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Header Section -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('messages.Delete Invoice') }}: {{$singleInvoice->patient->name}}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form Section -->
            <form action="{{route('invoices.destroy',['invoice'=>$singleInvoice->id])}}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        <h4>{{ __('messages.Confirm Delete Invoice') }}</h4>
                        <h3 {{$singleInvoice->service ? $x=$singleInvoice->service->name : $x=$singleInvoice->group->name}}>
                            {{$x}}
                        </h3>
                        <p>{{ __('messages.Action Cannot Be Undone') }}</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.Cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('messages.Yes, Delete') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

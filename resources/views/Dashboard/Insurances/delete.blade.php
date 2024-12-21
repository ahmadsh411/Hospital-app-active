<!-- نافذة منبثقة: حذف التأمين -->
<div class="modal fade" id="deleteInsuranceModal{{$insurance->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- القسم العلوي -->
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ __('insurance.delete_insurance') }}: {{$insurance->company_name}}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('insurance.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- نموذج الحذف -->
            <form action="{{ route('insurance-company.destroy', ['insurance_company' => $insurance->id]) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        <h4>{{ __('insurance.delete_confirmation') }}</h4>
                        <p>{{ __('insurance.delete_warning') }}</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('insurance.cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('insurance.delete') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

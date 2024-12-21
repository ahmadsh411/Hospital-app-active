<!-- نافذة منبثقة: إضافة تأمين -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- لتكبير النافذة -->
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('insurance.add_new') }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('buttons.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('insurance-company.store') }}" method="POST" autocomplete="off">
                <div class="modal-body p-4">
                    @csrf
                    <div class="row">
                        <!-- اسم الشركة -->
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">{{ __('insurance.company_name') }}:</label>
                            <input type="text" name="name" id="company_name" class="form-control" placeholder="{{ __('placeholders.company_name') }}" required>
                        </div>
                        <!-- رمز الشركة -->
                        <div class="col-md-6 mb-3">
                            <label for="company_code" class="form-label">{{ __('insurance.company_code') }}:</label>
                            <input type="text" name="code" id="company_code" class="form-control" placeholder="{{ __('placeholders.company_code') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- بريد الشركة الإلكتروني -->
                        <div class="col-md-6 mb-3">
                            <label for="company_email" class="form-label">{{ __('insurance.company_email') }}:</label>
                            <input type="email" name="email" id="company_email" class="form-control" placeholder="{{ __('placeholders.company_email') }}" required>
                        </div>
                        <!-- معدل الشركة -->
                        <div class="col-md-6 mb-3">
                            <label for="company_rate" class="form-label">{{ __('insurance.company_rate') }}:</label>
                            <input type="number" step="0.01" name="company_rate" id="company_rate" class="form-control" placeholder="{{ __('placeholders.company_rate') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <!-- تحمل المريض -->
                        <div class="col-md-6 mb-3">
                            <label for="patient_tolerance" class="form-label">{{ __('insurance.patient_tolerance') }}:</label>
                            <input type="number" name="patient_tolerance" id="patient_tolerance" class="form-control" placeholder="{{ __('placeholders.patient_tolerance') }}" required>
                        </div>
                        <!-- الحالة -->
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">{{ __('insurance.status') }}:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1">{{ __('insurance.active') }}</option>
                                <option value="0">{{ __('insurance.inactive') }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- ملاحظات -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">{{ __('insurance.notes') }}:</label>
                        <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="{{ __('placeholders.notes') }}"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('insurance.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('insurance.add') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

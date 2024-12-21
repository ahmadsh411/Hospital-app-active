<!-- مودال لإنشاء سند جديد بشكل يشبه الشيك -->
<div class="modal fade" id="createReceiptModal" tabindex="-1" aria-labelledby="createReceiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-4" style="border: 2px solid #000; background-color: #f9f9f9; border-radius: 15px;">
            <div class="modal-header">
                <h5 class="modal-title" id="createReceiptModalLabel" style="font-weight: bold;">{{ trans('messages.create_receipt') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('messages.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('receipt-box.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Date Field -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label for="date" class="form-label" style="font-weight: bold;">{{ trans('messages.date') }}</label>
                            <input type="date" class="form-control form-control-lg border-dark" id="date" name="date" required>
                        </div>
                        <!-- Select Patient -->
                        <div class="col-md-4">
                            <label for="patient_id" class="form-label" style="font-weight: bold;">{{ trans('messages.beneficiary_name') }}</label>
                            <select class="form-select form-select-lg border-dark" id="patient_id" name="patient_id" required>
                                <option id="searchPatient" class="form-control mb-2"></option>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" data-bill="{{ $patient->patientAccount->sum('debit') - $patient->patientAccount->sum('credit') }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Invoice Field -->
                        <div class="col-md-4">
                            <label for="patient_bill" class="form-label" style="font-weight: bold;">{{ trans('messages.invoice') }}</label>
                            <input type="text" class="form-control form-control-lg border-dark" id="patient_bill" name="patient_bill" readonly>
                        </div>
                        <script>
                            // Update the invoice field when a patient is selected
                            document.getElementById('patient_id').addEventListener('change', function() {
                                var selectedOption = this.options[this.selectedIndex];
                                var billAmount = selectedOption.getAttribute('data-bill') || 0;
                                document.getElementById('patient_bill').value = billAmount;
                            });
                        </script>
                    </div>
                    <!-- Amount Field -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="debit" class="form-label" style="font-weight: bold;">{{ trans('messages.amount') }}</label>
                            <input type="number" step="0.01" class="form-control form-control-lg border-dark" id="debit" name="debit" placeholder="0.00" required>
                        </div>
                    </div>
                    <!-- Description -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="description" class="form-label" style="font-weight: bold;">{{ trans('messages.description') }}</label>
                            <textarea class="form-control form-control-lg border-dark" id="description" name="description" rows="3" placeholder="{{ trans('messages.enter_details') }}"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Footer with Save Button -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('messages.close') }}</button>
                    <button type="submit" class="btn btn-primary" style="background-color: #0d6efd; border-radius: 50px; padding: 10px 20px;">{{ trans('messages.save_receipt') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- تفعيل مكتبة Select2 على قائمة المرضى -->
<script>
    $(document).ready(function() {
        // تفعيل Select2 على قائمة اختيار المرضى
        $('#patient_id').select2({
            placeholder: 'ابحث عن اسم المريض',
            allowClear: true,
            width: '100%' // لضمان التوافق الكامل مع عرض العنصر
        });
    });
</script>
<script>
    document.getElementById('searchPatient').addEventListener('keyup', function() {
        var searchValue = this.value.toLowerCase();
        var options = document.getElementById('patient_id').options;

        for (var i = 0; i < options.length; i++) {
            var optionText = options[i].text.toLowerCase();
            if (optionText.includes(searchValue)) {
                options[i].style.display = 'block';
            } else {
                options[i].style.display = 'none';
            }
        }
    });
</script>

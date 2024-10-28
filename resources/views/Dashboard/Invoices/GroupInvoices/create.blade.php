<div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="createInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createInvoiceModalLabel">Create New Invoice</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form to Create New Invoice with Horizontal Layout -->
                <form action="{{route('group-invoices.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Patient -->
                        <div class="form-group col-md-6">
                            <label for="patient_id">Patient</label>
                            <select class="form-control" id="patient_id" name="patient_id" required>
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Doctor -->
                        <div class="form-group col-md-6">
                            <label for="doctor_id">Doctor</label>
                            <select class="form-control" id="doctor_id" name="doctor_id" required>
                                <option value="">Select Doctor</option>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" data-section-id="{{ $doctor->section->id }}" data-section-name="{{ $doctor->section->name }}">
                                        {{ $doctor->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Section (Hidden ID and visible Name) -->
                        <input type="hidden" class="form-control" id="section_id" name="section_id" readonly>
                        <div class="form-group col-md-6">
                            <label for="section_name">Section Name</label>
                            <input type="text" class="form-control" id="section_name" placeholder="Section will appear here" readonly>
                        </div>

                        <script>
                            document.getElementById('doctor_id').addEventListener('change', function() {
                                var selectedDoctor = this.options[this.selectedIndex];
                                var sectionId = selectedDoctor.getAttribute('data-section-id');
                                var sectionName = selectedDoctor.getAttribute('data-section-name');
                                document.getElementById('section_id').value = sectionId || '';
                                document.getElementById('section_name').value = sectionName || '';
                            });
                        </script>

                        <!-- Service -->
                        <div class="form-group col-md-6">
                            <label for="service_id">Service</label>
                            <select class="form-control" id="service_id" name="service_id" required>
                                <option value="">Select Service</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}"
                                            data-price="{{ $service->total_before_discount }}"
                                            data-discount="{{ $service->discount_value }}"
                                            data-tax-rate="{{ $service->tax_rate }}">
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price (Readonly) -->
                        <div class="form-group col-md-6">
                            <label for="price">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required readonly>
                        </div>

                        <!-- Discount -->
                        <div class="form-group col-md-6">
                            <label for="discount_value">Discount</label>
                            <input type="number" step="0.01" class="form-control" id="discount_value" name="discount_value" required>
                        </div>

                        <!-- Tax Rate -->
                        <div class="form-group col-md-6">
                            <label for="tax_rate">Tax Rate</label>
                            <input type="number" step="0.01" class="form-control" id="tax_rate" name="tax_rate" required>
                        </div>

                        <!-- Tax Value -->
                        <div class="form-group col-md-6">
                            <label for="tax_value">Tax Value</label>
                            <input type="number" step="0.01" class="form-control" id="tax_value" name="tax_value" readonly>
                        </div>

                        <!-- Total with Tax -->
                        <div class="form-group col-md-6">
                            <label for="tot_with_tax">Total with Tax</label>
                            <input type="number" step="0.01" class="form-control" id="tot_with_tax" name="tot_with_tax" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="doctor_id">Invoice Type</label>
                            <select class="form-control" id="type" name="type" required >
                                <option value="" disabled>Select Type</option>
                                <option value="1">monetary</option>
                                <option value="0">Postponed</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    // عند تغيير الخدمة، جلب القيم من قاعدة البيانات وتحديث الحقول
document.getElementById('service_id').addEventListener('change', function() {
    var selectedService = this.options[this.selectedIndex];

    // جلب السعر، الخصم، ونسبة الضريبة
    var servicePrice = selectedService.getAttribute('data-price');
    var serviceDiscount = selectedService.getAttribute('data-discount');
    var serviceTaxRate = selectedService.getAttribute('data-tax-rate');

    // تحديث الحقول بالقيم
    document.getElementById('price').value = servicePrice ? parseFloat(servicePrice).toFixed(2) : '';
    document.getElementById('discount_value').value = serviceDiscount ? parseFloat(serviceDiscount).toFixed(2) : '';
    document.getElementById('tax_rate').value = serviceTaxRate ? parseFloat(serviceTaxRate).toFixed(2) : '';

    // إعادة حساب الفاتورة بعد تحديث القيم
    calculateInvoice();
});

// دالة لحساب الفاتورة الإجمالية بعد الخصم والضريبة
function calculateInvoice() {
    var price = parseFloat(document.getElementById('price').value) || 0;
    var discount = parseFloat(document.getElementById('discount_value').value) || 0;
    var taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;

    // الحساب قبل الضريبة وبعد الخصم
    var totalBeforeTax = price - discount;

    // التأكد من أن الخصم لا يتجاوز السعر
    if (totalBeforeTax < 0) {
        totalBeforeTax = 0;
    }

    // حساب قيمة الضريبة
    var taxValue = (totalBeforeTax * taxRate) / 100;

    // المجموع النهائي بعد الضريبة
    var totalWithTax = totalBeforeTax + taxValue;

    // تحديث الحقول بالقيم المحسوبة
    document.getElementById('tax_value').value = taxValue.toFixed(2);
    document.getElementById('tot_with_tax').value = totalWithTax.toFixed(2);
}

// إضافة أحداث لإعادة الحساب عند تعديل المدخلات
document.getElementById('discount_value').addEventListener('input', calculateInvoice);
document.getElementById('tax_rate').addEventListener('input', calculateInvoice);

</script>

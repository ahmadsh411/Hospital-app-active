<div class="modal fade" id="createInvoicesModal" tabindex="-1" role="dialog" aria-labelledby="createInvoiceModalLabel" aria-hidden="true">
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
                <form action="{{route('invoices.store')}}" method="POST">
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
        // جلب الطبيب المختار
        var selectedDoctor = this.options[this.selectedIndex];
        // جلب معرف القسم واسم القسم من البيانات
        var sectionId = selectedDoctor.getAttribute('data-section-id'); // استخدم data-section-id لمعرف القسم
        var sectionName = selectedDoctor.getAttribute('data-section-name'); // استخدم data-section-name لاسم القسم

        // تحديث حقل معرف القسم (مخفي)
        document.getElementById('section_id').value = sectionId ? sectionId : '';
        // تحديث حقل اسم القسم (ظاهر)
        document.getElementById('section_name').value = sectionName ? sectionName : '';
    });
</script>

                       <!-- Service -->
<!-- تعديل قائمة الخدمات لإضافة خيار للخدمات المجتمعة -->
<div class="form-group col-md-6">
    <label for="service_type">Service Type</label>
    <select class="form-control" id="service_type" name="service_type" required>
        <option value="" disabled selected>Select Service Type</option>
        <option value="single">Single Service</option>
        <option value="grouped">Grouped Services</option>
    </select>
</div>

<!-- قائمة الخدمات المفردة -->
<div class="form-group col-md-6" id="single_service_container" style="display: none;">
    <label for="single_service_id">Single Service</label>
    <select class="form-control" id="single_service_id" name="service_id">
        <option value="">Select Single Service</option>
        @foreach($services as $service)
            <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }}</option>
        @endforeach
    </select>
</div>


<!-- قائمة الخدمات المجتمعة -->
<div class="form-group col-md-6" id="grouped_service_container" style="display: none;">
    <label for="grouped_service_id">Grouped Services</label>
    <select class="form-control" id="grouped_service_id" name="group_id">
        <option value="">Select Grouped Services</option>
        @foreach($groups as $group)
            <option value="{{ $group->id }}"
                    data-total="{{ $group->total_before_discount }}"
                    data-discount="{{ $group->discount_value }}"
                    data-tax-rate="{{ $group->tax_rate }}">
                {{ $group->name }}
            </option>
        @endforeach
    </select>
</div>




<!-- سعر الخدمة المختارة -->
 <div class="form-group col-md-6">
    <label for="price">Price</label>
    <input type="number" step="0.01" class="form-control" id="price" name="price" required readonly>
 </div>
 <script>
    // إظهار/إخفاء الحقول بناءً على نوع الخدمة
document.getElementById('service_type').addEventListener('change', function() {
    var serviceType = this.value;

    // إظهار الحقول بناءً على اختيار الخدمة (مفردة أو مجموعة)
    if (serviceType === 'single') {
        document.getElementById('single_service_container').style.display = 'block';
        document.getElementById('grouped_service_container').style.display = 'none';
    } else if (serviceType === 'grouped') {
        document.getElementById('single_service_container').style.display = 'none';
        document.getElementById('grouped_service_container').style.display = 'block';
    } else {
        document.getElementById('single_service_container').style.display = 'none';
        document.getElementById('grouped_service_container').style.display = 'none';
    }

    // إعادة تعيين السعر عند تغيير النوع
    document.getElementById('price').value = '';
});

// تحديث السعر بناءً على الخدمة المفردة المختارة
document.getElementById('single_service_id').addEventListener('change', function() {
    var selectedService = this.options[this.selectedIndex];
    var servicePrice = selectedService.getAttribute('data-price');
    document.getElementById('price').value = servicePrice ? parseFloat(servicePrice).toFixed(2) : '';
    calculateInvoice();
});

// تحديث السعر بناءً على الخدمة المجتمعة المختارة
document.getElementById('grouped_service_id').addEventListener('change', function() {
    var selectedGroup = this.options[this.selectedIndex];
    var groupTotal = selectedGroup.getAttribute('data-total');
    document.getElementById('price').value = groupTotal ? parseFloat(groupTotal).toFixed(2) : '';
    calculateInvoice();
});
// تحديث السعر والخصم والضريبة بناءً على الخدمة المجتمعة المختارة
document.getElementById('grouped_service_id').addEventListener('change', function() {
    var selectedGroup = this.options[this.selectedIndex];

    // جلب القيم من البيانات المضافة
    var groupTotal = selectedGroup.getAttribute('data-total');
    var groupDiscount = selectedGroup.getAttribute('data-discount');
    var groupTaxRate = selectedGroup.getAttribute('data-tax-rate');

    // تحديث الحقول تلقائيًا
    document.getElementById('price').value = groupTotal ? parseFloat(groupTotal).toFixed(2) : '';
    document.getElementById('discount_value').value = groupDiscount ? parseFloat(groupDiscount).toFixed(2) : '';
    document.getElementById('tax_rate').value = groupTaxRate ? parseFloat(groupTaxRate).toFixed(2) : '';

    // إعادة حساب الفاتورة مع القيم الجديدة
    calculateInvoice();
});
// Function to calculate the total with tax
function calculateInvoice() {
    var price = parseFloat(document.getElementById('price').value) || 0;
    var discount = parseFloat(document.getElementById('discount_value').value) || 0;
    var taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;

    // الحساب قبل الضريبة وبعد الخصم
    var totalBeforeTax = price - discount;

    // حساب قيمة الضريبة
    var taxValue = (totalBeforeTax * taxRate) / 100;

    // المجموع النهائي بعد إضافة الضريبة
    var totalWithTax = totalBeforeTax + taxValue;

    // تحديث الحقول تلقائيًا
    document.getElementById('tax_value').value = taxValue.toFixed(2);
    document.getElementById('tot_with_tax').value = totalWithTax.toFixed(2);
}

// إضافة أحداث عند تغيير الحقول للحساب
document.getElementById('price').addEventListener('input', calculateInvoice);
document.getElementById('discount_value').addEventListener('input', calculateInvoice);
document.getElementById('tax_rate').addEventListener('input', calculateInvoice);


 </script>


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
                        {{-- <div class="form-group col-md-6">
                            <label for="doctor_id">Invoice Type</label>
                            <select class="form-control" id="type" name="invoice_type" required >
                                <option value="" disabled>Select Type</option>
                                <option value="1">Group</option>
                                <option value="0">Single</option>

                            </select>
                        </div> --}}

                        <div class="form-group col-md-6">
                            <label for="doctor_id">Invoice status</label>
                            <select class="form-control" id="type" name="invoice_status" required >
                                <option value="" disabled>Select Status</option>
                                <option value="1">كشف منتهي</option>
                                <option value="0">تحت الكشف</option>

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

<!-- JavaScript to handle calculations -->
<script>
    // Function to calculate the total with tax
    function calculateInvoice() {
        var price = parseFloat(document.getElementById('price').value) || 0;
        var discount = parseFloat(document.getElementById('discount_value').value) || 0;
        var taxRate = parseFloat(document.getElementById('tax_rate').value) || 0;

        // الحساب قبل الضريبة وبعد الخصم
        var totalBeforeTax = price - discount;
        // حساب قيمة الضريبة
        var taxValue = (totalBeforeTax * taxRate) / 100;
        // المجموع النهائي بعد إضافة الضريبة
        var totalWithTax = totalBeforeTax + taxValue;

        // تحديث الحقول تلقائيًا
        document.getElementById('tax_value').value = taxValue.toFixed(2);
        document.getElementById('tot_with_tax').value = totalWithTax.toFixed(2);
    }

    // إضافة أحداث عند تغيير الحقول للحساب
    document.getElementById('price').addEventListener('input', calculateInvoice);
    document.getElementById('discount_value').addEventListener('input', calculateInvoice);
    document.getElementById('tax_rate').addEventListener('input', calculateInvoice);
</script>
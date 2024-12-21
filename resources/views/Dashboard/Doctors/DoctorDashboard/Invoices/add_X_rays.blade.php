<!-- Modal لإضافة أشعة -->
<div class="modal fade" id="addRayModal{{ $invoice->id }}" tabindex="-1" role="dialog" aria-labelledby="addRayLabel{{ $invoice->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addRayLabel{{ $invoice->id }}">
                    <i class="fas fa-x-ray"></i> {{ __('messages.add_ray') }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="{{ __('messages.close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- نموذج إضافة الأشعة -->
                <form action="{{ route('rays.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="description">
                            <i class="fas fa-file-alt"></i> {{ __('messages.ray_description') }}
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="3" required placeholder="{{ __('messages.enter_description') }}"></textarea>
                    </div>
                    <!-- حقول مخفية لربط البيانات -->
                    <input type="hidden" value="{{ $invoice->patient->id }}" name="patient_id">
                    <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
                    <input type="hidden" value="{{ $invoice->doctor->id }}" name="doctor_id">
                    <div class="form-group">
                        <label for="image">
                            <i class="fas fa-upload"></i> {{ __('messages.upload_ray_image') }}
                        </label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                    </div>
                    <!-- مكان عرض الصورة -->
                    <div class="form-group text-center">
                        <img id="imagePreview" src="" alt="{{ __('messages.image_preview') }}" style="max-width: 100%; height: auto; display: none; border: 2px solid #ddd; padding: 5px; margin-top: 10px;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times"></i> {{ __('messages.close') }}
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('messages.save_ray') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript لعرض معاينة الصورة عند اختيار ملف
    function previewImage(event) {
        var reader = new FileReader();
        var imagePreview = document.getElementById('imagePreview');
        reader.onload = function() {
            if (reader.readyState === 2) {
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<!-- مودال الحذف -->
<div class="modal fade" id="deleteLaboratory{{$patientLaboratory->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف لـ {{$patientLaboratory->description}}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p style="font-size: 18px; font-weight: bold;">هل أنت متأكد من أنك تريد حذف هذا التحليل؟ هذه العملية لا يمكن التراجع عنها!</p>
                <i class="fas fa-exclamation-triangle fa-5x text-warning mb-3 animate__animated animate__tada"></i>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal" style="border-radius: 30px; padding: 10px 20px;">إلغاء</button>

                <!-- زر تأكيد الحذف -->
                <form method="POST" action="{{route('laboratories.destroy',['laboratory'=>$patientLaboratory->id])}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg" style="border-radius: 30px; padding: 10px 20px;">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- إضافة مكتبة animate.css للحركات -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
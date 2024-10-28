<!-- Modal للتأكيد على الحذف -->
<div class="modal fade" id="deleteReceipt{{$receipt->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$receipt->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 2px solid #dc3545; border-radius: 15px;">
            <div class="modal-header" style="background: linear-gradient(45deg, #f44336, #e57373);">
                <h5 class="modal-title text-white" id="deleteModalLabel{{$receipt->id}}">حذف السند المالي: {{$receipt->id}}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('receipt-box.destroy', ['receipt_box'=>$receipt->id])}}" method="POST" autocomplete="off">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <div>
                        <h4 style="color: #dc3545;">هل أنت متأكد أنك تريد حذف هذا السند المالي؟</h4>
                        <p style="font-size: 18px; color: #555;">هذه العملية لا يمكن التراجع عنها.</p>
                    </div>

                    <!-- إضافة حركة لتغيير اللون عند التمرير -->
                    <div style="font-size: 80px; color: #f44336; animation: pulse 1.5s infinite;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 25px;">إلغاء</button>
                    <button type="submit" class="btn btn-danger" style="border-radius: 25px; background: linear-gradient(45deg, #f44336, #e57373);">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- إضافة CSS للرسوم المتحركة -->
<style>
    @keyframes pulse {
        0% {
            transform: scale(1);
            color: #f44336;
        }
        50% {
            transform: scale(1.1);
            color: #ff7961;
        }
        100% {
            transform: scale(1);
            color: #f44336;
        }
    }
</style>

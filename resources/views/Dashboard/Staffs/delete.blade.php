<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteStaffModal{{ $staff->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);">

            <!-- Modal Header with gradient background -->
            <div class="modal-header" style="background: linear-gradient(135deg, #ff4d4d, #ff0000); color: white;">
                <h5 class="modal-title" id="deleteStaffModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body with animated icon and smooth color change -->
            <div class="modal-body text-center" style="background-color: #fff8f8; transition: background-color 0.3s ease;">
                <i class="fas fa-exclamation-triangle" style="font-size: 40px; color: #ff4d4d; margin-bottom: 15px; animation: shake 0.7s infinite alternate;"></i>
                <p style="color: #ff4d4d; font-size: 18px;">Are you sure you want to delete this staff member: <strong>{{ $staff->name }}</strong>?</p>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer" style="background-color: #fff0f0; transition: background-color 0.3s ease;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="transition: all 0.3s;">Cancel</button>
                <form action="{{ route('staff-hospital.destroy',['staff_hospital'=> $staff->id]) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger delete-btn" style="background-color: #ff4d4d; border: none; transition: all 0.3s;">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for adding smooth animations and transitions -->
<script>
    $(document).ready(function() {
        // Smooth animation when opening the modal
        $('#deleteStaffModal{{ $staff->id }}').on('show.bs.modal', function () {
            $(this).find('.modal-content').css({
                opacity: 0,
                transform: 'scale(0.5)',  // Start with smaller scale
                transition: 'all 0.5s ease-in-out'  // Smooth transition for scale and opacity
            }).animate({
                opacity: 1,
                transform: 'scale(1)'  // Full size
            }, 500);
        });

        // Shake animation for the warning icon
        $('.fas.fa-exclamation-triangle').hover(function() {
            $(this).css('animation', 'none');  // Stop shaking on hover
        }, function() {
            $(this).css('animation', 'shake 0.7s infinite alternate');  // Start shaking again after hover
        });

        // Add hover effect for the delete button
        $('.delete-btn').hover(function() {
            $(this).css({
                'background-color': '#ff1a1a',
                'transform': 'scale(1.1)',
                'box-shadow': '0 4px 8px rgba(255, 0, 0, 0.3)'
            });
        }, function() {
            $(this).css({
                'background-color': '#ff4d4d',
                'transform': 'scale(1)',
                'box-shadow': 'none'
            });
        });
    });
</script>

<!-- CSS for shake animation -->
<style>
    @keyframes shake {
        0% { transform: translateX(-5px); }
        100% { transform: translateX(5px); }
    }
</style>

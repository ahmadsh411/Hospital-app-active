<!-- Modal: Add Service -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- استخدم modal-lg لتوسيع الـ modal -->
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel">Add New Service</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Form -->
            <form action="{{route('multi-services.store')}}" method="POST" autocomplete="off">
                @csrf

                <!-- Body -->
                <div class="modal-body">
                    <!-- Service Name -->
                    <div class="form-group">
                        <label for="service_name" class="font-weight-bold">Service Name:</label>
                        <input type="text" id="service_name" name="name" placeholder="Enter The Service Name" class="form-control" required/>
                    </div>

                    <!-- Service Notes -->
                    <div class="form-group">
                        <label for="service_notes" class="font-weight-bold">Service Notes:</label>
                        <textarea id="service_notes" name="notes" class="form-control" rows="3" placeholder="Enter any notes"></textarea>
                    </div>

                    <!-- Services and Quantities -->
                    <div id="services-container">
                        <div class="service-item row mb-3">
                            <div class="col-md-8">
                                <label class="font-weight-bold">Choose Service:</label>
                                <select class="form-control" name="service_id[]">
                                    <option value="" disabled selected>Select a Service</option>
                                    @foreach($singleServices as $singleService)
                                        <option value="{{$singleService->id}}">
                                            {{$singleService->name}} - {{$singleService->price}}$
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="font-weight-bold">Quantity</label>
                                <input type="number" name="quantity_[]" value="1" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <!-- Add Another Service Button -->
                    <div class="text-right mb-3">
                        <button type="button" id="addServiceBtn" class="btn btn-outline-primary">
                            <i class="mdi mdi-plus"></i> Add Another Service
                        </button>
                    </div>

                    <!-- Discount -->
                    <div class="form-group">
                        <label for="discount_value" class="font-weight-bold">Discount Value:</label>
                        <input type="number" id="discount_value" name="discount_value" value="0" class="form-control" placeholder="Enter discount value"/>
                    </div>

                    <!-- Tax Rate -->
                    <div class="form-group">
                        <label for="tax_rate" class="font-weight-bold">Tax Rate (%):</label>
                        <input type="number" id="tax_rate" name="tax_rate" class="form-control" placeholder="Enter tax rate"/>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript to Add New Service Field -->
<script>
    document.getElementById('addServiceBtn').addEventListener('click', function() {
        // Clone the service item
        const container = document.getElementById('services-container');
        const newServiceItem = container.querySelector('.service-item').cloneNode(true);

        // Reset the newly cloned fields
        newServiceItem.querySelector('select').value = ""; // Reset the service selection
        newServiceItem.querySelector('input[type="number"]').value = 1; // Reset the quantity to 1

        // Append the new service item to the container
        container.appendChild(newServiceItem);
    });
</script>
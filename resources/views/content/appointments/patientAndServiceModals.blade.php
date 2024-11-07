<style>
    .modal-content {
        border-radius: 15px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        0% { opacity: 0; transform: scale(0.9); }
        100% { opacity: 1; transform: scale(1); }
    }
    
    .form-control {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
    }
    .btn-custom {
        background-color: #007bff;
        color: white;
        border-radius: 8px;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .btn-custom:hover {
        background-color: #0056b3;
        color:ghostwhite;
    }

</style>

<!-- Patient Create Modal -->
<div class="modal fade" id="patientRegisterModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Register Patient</h5>
                <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="patientForm">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="patientName" placeholder="Enter your name">
                    </div>

                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter your username">
                        <small> Same will be used as Password</small>
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="patient_phone" placeholder="Enter your phone number">
                    </div>

                    <!-- Doctor Select Field -->
                    <div class="mb-3">
                        <label for="doctor" class="form-label">Select Doctor</label><br>
                        <select class="form-select patientDoctor" id="select2">
                            <option selected>Select a doctor</option>
                            @foreach($doctors as $doctor)
                            <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-custom" id="patientRegisterSubmit">Submit</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="serviceRegisterModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Register Patient</h5>
                <button type="button" class="" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body">
                <form id="serviceForm">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="serviceName" name="name" placeholder="Enter service name">
                    </div>

                    <!-- Duration Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Duratiom</label>
                        <input type="number" class="form-control" id="duration" name="duration" placeholder="Enter duration ... 1 hour">
                    </div>

                    <!-- Price Field -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Cost Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter Cost">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-custom" id="serviceRegisterSubmit">Submit</button>
            </div>
        </div>
    </div>
</div>
@push('page-scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#patientRegisterSubmit').click(function(){
            const patientData = {
                name: $('#patientName').val(),
                username: $('#username').val(),
                phone: $('#patient_phone').val(),
                doctor: $('.patientDoctor').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('patient.register') }}',
                type: 'POST',
                data: patientData,
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Patient registered successfully!'
                    }).then(() => {
                        $('#patientForm')[0].reset();
                        $('#patientRegisterModal').modal('hide');

                        const newOption = new Option(
                            `#${response.registration_id} - ${response.name}`, 
                            response.id, 
                            true, 
                            true
                            );
                        $(newOption).attr('data-phone', response.phone);
                        $('#patient_select').append(newOption).trigger('change');
                        $('#patient_select').val(response.id).trigger('change');
                    });
                },
                error: function(xhr) {
                    console.log(xhr);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred. Please try again.'
                    });
                }
            });
        });
        $('#serviceRegisterSubmit').click(function(){
            const serviceData = {
                name: $('#serviceName').val(),
                duration: $('#duration').val(),
                price: $('#price').val(),
                _token: '{{ csrf_token() }}'
            };
            $.ajax({
                url: '{{ route('service.store') }}',
                type: 'POST',
                data: serviceData,
                success: function(response) {
                    Swal.fire({
                        title: 'Success',
                        text: 'Patient registered successfully!'
                    }).then(() => {
                        $('#serviceForm')[0].reset();
                        $('#serviceRegisterModal').modal('hide');

                        const newOption = new Option(
                            `${response.name}`, 
                            response.id, 
                            true, 
                            true
                            );
                        $(newOption).attr('data-phone', response.phone);
                        $('#service_select').append(newOption).trigger('change');
                        $('#service_select').val(response.id).trigger('change');
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred. Please try again.'
                    });
                }
            });
        });
    });
    
</script>
@endpush
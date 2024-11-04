@extends('layouts/contentNavbarLayout')

@section('title', 'Examination')

@section('content')
@include('content.examination.historyModal')
<div class="row">
    <div class="col-xxl">
        <div class="card p-5">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="mb-0">Examination</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        {{-- <th>Patient Id</th>     --}}
                        <th>Patient Name</th>
                        <th>Doctor</th>    
                        <th>Appointment Time</th>
                        <th>History</th>
                        <th>Prescription</th>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td>#{{ $appointment->patient->registration_id ?? 'Unregistered' }}</td>     --}}
                            <td>{{ $appointment->patient->name ?? $appointment->name }}</td>
                            <td>{{ $appointment->user->name }}</td>    
                            <td>{{ \Carbon\Carbon::parse($appointment->start_date_time)->format('D, F j, Y g:i A') }}</td>
                            <td><button class="btn btn-primary historyModalBtn" data-patient_id="{{ $appointment->patient_id }}">History</button></td>
                            <td><a href="{{ route('prescription.create', ['id' => $appointment->id]) }}" class="btn btn-primary">Prescription</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <form method="POST" id="examinationForm">
                    @csrf
                    <div class="container p-5 row">
                        <div class="col-md-3">
                            <label for="doctors" class="form-label">Choose Doctor</label>
                            <select class="form-select" name="doctor_id" id="doctors">
                                <option disabled selected>Select</option>
                                @foreach($doctors as $doctor)
                                <option @if($appointment->user_id == $doctor->id) selected @endif value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="service" class="form-label">Select Service</label>
                            <select class="form-select" name="service_id" id="service">
                                <option disabled selected>Select</option>
                                @foreach($services as $service)
                                <option value="{{ $service->id }}" data-amount="{{ $service->price }}" >{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" name="price" id="amount">
                        </div>
                        <div class="col-md-3">
                            <label></label>
                            <button type="submit" id="saveButton1" class="btn btn-primary d-grid w-100">Add</button>
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">
                    <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
                    <button type="submit" class="btn btn-primary d-grid w-100" id="saveButton2">
                        Save
                    </button>
                </form>
            </div>
            <hr>

            <h3>Procedures</h3>
            <div class="table-responsive text-nowrap">
                <table class="table datatable">
                    <thead class="table-dark">
                        <th>Patient</th>
                        <th>Doctor</th>
                        <th>DateTime</th>
                        <th>Procedure</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($examinations as $examination)
                        <tr>
                            <td>{{ $examination->appointment->name }}</td>
                            <td class="text-center">{{ $examination->doctor->name }}</td>
                            <td>{{ $examination->appointment->start_date_time }}</td>
                            <td>{{ $examination->service->name }}</td>
                            <td>{{ $examination->price }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('examination.edit', ['id' => $examination->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="{{ route('examination.delete', ['id' => $examination->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('page-scripts')
<script type="text/javascript">
    $(function() {
        var selectedOption = $('#service').find('option:selected');
        $('#amount').val(selectedOption.data('amount'))

        $('#service').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            $('#amount').val(selectedOption.data('amount'))
        });
    });

    document.getElementById('saveButton1').addEventListener('click', function() {
        document.getElementById('examinationForm').action = "{{ route('examination.store') }}";
    });

    document.getElementById('saveButton2').addEventListener('click', function() {
        document.getElementById('examinationForm').action = "{{ route('examination.complete', ['id' => $appointment->id]) }}";
    });
</script>
@endpush

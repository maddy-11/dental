@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Examination')
@section('nav-title', 'Edit Examination')

@section('content')
<div class="row">
<!-- Basic Layout -->
<div class="col-xxl">
	<div class="card p-5">
		<div class="d-flex align-items-center justify-content-between">
			<h5 class="mb-0">Edit Examination</h5>
		</div>
		<div class="table-responsive text-nowrap">
			<table class="table">
				<thead>
					<th>Patient Id</th>	
					<th>Patient Name</th>
					<th>Doctor</th>	
					<th>Appointment Time</th>
				</thead>
				<tbody>
					<td>#{{ $examination->appointment->patient->registration_id }}</td>	
					<td>{{ $examination->appointment->patient->name }}</td>
					<td>{{ $examination->appointment->user->name }}</td>	
					<td>{{ \Carbon\Carbon::parse($examination->appointment->start_date_time)->format('D, F j, Y g:i A') }}</td>
				</tbody>
			</table>
		</div>
		<div class="mt-5">
			<form action="{{ route('examination.store') }}" method="POST">
				@csrf
				<div class="container p-5 row">
					<div class="col-md-4">
						<label for="doctors" class="form-label">Choose Doctor</label>
						<select class="form-select" name="doctor_id" id="doctors">
							<option disabled selected>Select</option>
							@foreach($doctors as $doctor)
							<option  @if($examination->doctor_id == $doctor->id) selected @endif value="{{ $doctor->id }}">{{ $doctor->name }}</option>
							@endforeach
						</select>
					</div>

					{{-- ///////////////////////////// --}}

					<div class="col-md-4">
						<label for="service" class="form-label">Select Service</label>
						<select class="form-select" name="service_id" id="service">
							<option disabled selected>Select</option>
							@foreach($services as $service)
							<option value="{{ $service->id }}" data-amount="{{ $service->price }}" value="{{ $service->id }}">{{ $service->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-md-4">
						<label for="amount" class="form-label">Amount</label>
						<input type="number" class="form-control" name="price" id="amount">
					</div>
				</div>
				<input type="hidden" name="patient_id" value="{{ $examination->patient_id }}">
				<input type="hidden" name="appointment_id" value="{{ $examination->appointment_id }}">
				<button type="submit" class="btn btn-primary d-grid w-100">
					Add
				</button>
			</form>
		</div>
			<hr>
		<h3>Procedures</h3>
            <div class="table-responsive text-nowrap">
                <table class="table datatable">
                    <thead class="table-dark">
                        {{-- <th>Patient</th> --}}
                        <th>Doctor</th>
                        {{-- <th>DateTime</th> --}}
                        <th>Procedure</th>
                        <th>Amount</th>
                        <th>Actions</th>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($examinations as $examination)
                        <tr>
                            {{-- <td>{{ $examination->appointment->name }}</td> --}}
                            <td class="text-center">{{ $examination->doctor->name }}</td>
                            {{-- <td>{{ $examination->appointment->start_date_time }}</td> --}}
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
<style type="text/css">
	td, th{
		text-align:center!important;
	}
</style>
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

		$('#historyModalBtn').click(function() {
			$('#historyModal').modal('show');
		});
</script>

@endpush
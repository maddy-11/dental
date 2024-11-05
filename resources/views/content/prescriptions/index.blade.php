@extends('layouts/contentNavbarLayout')

@section('title', 'Prescriptions')
@section('nav-title', 'Prescriptions')

@section('content')
@include('content.examination.historyModal')
<style type="text/css">
    td, th{
        text-align:center !important;
    }
</style>
<!-- Bootstrap Table with Header - Dark -->
<div class="card">
  <div class="d-flex align-items-center justify-content-between">
    <h4 class="card-header">Prescriptions</h4>
  </div>
  <div class="table-responsive text-nowrap px-5">
    <table class="table datatable">
      <thead class="table-dark">
        <tr>
          <th class="text-center">Visit Date and Time</th>
          @if(Auth::user()->is_admin || Auth::user()->status == 'Patient')
          <th>Doctor</th>
          @endif
          @if(Auth::user()->is_admin || Auth::user()->status == 'Doctor')
          <th>Patient</th>
          @endif
          @if(Auth::user()->status == 'Patient')
          <th>Details</th>
          @endif
          <th>View</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($prescriptions as $prescription)
        <tr>
          <td>{{ \Carbon\Carbon::parse($prescription->appointment->start_date_time)->format('l, F j, Y g:i A') }}</td>
          @if(Auth::user()->is_admin || Auth::user()->status == 'Patient')
          <td class="text-center">{{ $prescription->appointment->user->name }}</td>
          @endif
          @if(Auth::user()->is_admin || Auth::user()->status == 'Doctor')
          <td class="text-center">{{ $prescription->appointment->patient->name }}</td>
          @endif
          @if(Auth::user()->status == 'Patient')
          <td><button class="btn btn-dark historyModalBtn" data-patient_id="{{ $prescription->appointment->patient_id }}">Details</button></td>
          @endif
          <td class="text-center"><a href="{{ route('prescription.get', ['id'=>$prescription->appointment->id]) }}" class="btn btn-primary text-white">View Prescription</a></td>
          <td class="text-center">
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                @if(Auth::user()->status == 'Doctor' || Auth::user()->is_admin)
                <a class="dropdown-item" href="{{ route('prescription.edit', ['id' => $prescription->appointment->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="{{ route('prescription.delete', ['id' => $prescription->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                @else
                <a class="dropdown-item" href="#"><i class="bx bx-abort me-1"></i> Not Allowed</a>
                @endif
              </div>
            </div>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
@endsection
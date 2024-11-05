@extends('layouts/contentNavbarLayout')

@section('title', 'Payments')
@section('nav-title', 'Payments')

@section('content')
<div class="card">
  {{-- <div class="d-flex justify-content-between align-items-center pe-3">
    <label>Patient</label><input type="text" readonly value="{{ $patient }}">
    <label>Appointment Date</label><input type="text" readonly value="{{ \Carbon\Carbon::parse($date)->format('l, F j, Y g:i A') }}">
  </div> --}}
  <div class="d-flex flex-column flex-md-row align-items-center gap-3 p-5 mt-md-0" style="background: ghostwhite;">
        <div class="row align-items-center container">
            <label class="col-md-3 col-4 text-nowrap mb-1 mb-sm-0 me-sm-2">Patient</label>
            <input class="col-md-5 col text-center justify-content-between p-2 bg-light border rounded" value="{{ $patient }}" readonly>
        </div>
        <div class="row align-items-center justify-content-between container">
            <label class="col-md-3 col-4 text-nowrap mb-1 mb-sm-0 me-sm-2">Date</label>
            <input class="col-md col text-center p-2 bg-light border rounded" value="{{ \Carbon\Carbon::parse($date)->format('l, F j, Y g:i A') }}" readonly>
        </div>
        <div class="row align-items-center justify-content-between container">
            <label class="col-md-4 col-4 text-nowrap mb-1 mb-sm-0 me-sm-2">Total Amount</label>
            <input class="col-md col text-center p-2 bg-light border rounded" value="{{ $total }}" readonly>
        </div>
    </div>

  <div class="table-responsive text-nowrap px-5">
    <table class="table datatable" id="paymentsTable">
      <thead class="table-dark">
        <tr>
          <th>Doctor</th>
          <th>Service</th>
          <th>Amount</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($payments as $payment)
        <tr>
        <td>{{ $payment->examination->appointment->user->name }}</td>
        <td>{{ $payment->examination->service->name }}</td>
        <td>
        <span class="bg-success rounded text-white btn btnSuccess">{{ $payment->amount }}</span>
        </td>
        <td>
          <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('payments.details.delete', ['id' => $payment->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
            </div>
        </td>
    </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<style>
.btnSuccess {
    background: #184301 !important;
}
td, th{
    text-align:center !important;
}

</style>

@endsection

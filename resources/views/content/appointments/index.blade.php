@extends('layouts/contentNavbarLayout')

@section('title', 'Appointments')
@section('nav-title', 'Appointments')

@section('content')

<!-- Bootstrap Table with Header - Dark -->
<div class="card">
  <div class="d-flex align-items-center justify-content-between">
    <h5 class="card-header">Appointments</h5>
    @if(Auth::user()->status == 'Doctor' || Auth::user()->is_admin == true)
    <a href="{{ route('appointments.create') }}" class="btn btn-primary me-2">Add New</a>
    @endif
    </div>
    <hr class="m-0 p-0">
  <div class="table-responsive text-nowrap p-5">
    <table class="table datatable">
      <thead class="table-dark">
        <tr>
          <th>Patient Name</th>
          <th>Doctor</th>
          <th>Service</th>
          <th>Time</th>
          <th>Phone</th>
          <th>Examination</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($appointments as $appointment)
        <tr>
          <td>{{ $appointment->name }}</td>
          <td>{{ $appointment->user->name ?? '' }}</td>
          <td>{{ $appointment->service->name ?? '' }}</td>
          <td>{{ \Carbon\Carbon::parse($appointment->start_date_time)->format('l, F j, Y g:i A') }}</td>
          <td>{{ $appointment->phone }}</td>
          <td><a href="{{ route('examination.create', ['id'=>$appointment->id]) }}" class="btn btn-primary">Examination</a></td>
          <td class="text-center">
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                @if(Auth::user()->is_admin == true)
                <a class="dropdown-item" href="{{ route('appointments.edit', ['id' => $appointment->id]) }}"><i class="bx bx-edit me-1"></i> Edit</a>
                <a class="dropdown-item" href="{{ route('appointments.delete', ['id' => $appointment->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                @else
                <a class="dropdown-item" href="javascript:void(0)">Not Admin</a>
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
@push('page-scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
    var $jq = $.noConflict(true);
    $jq(document).ready(function() {
        $jq('#datatable').DataTable();
    });
</script>
@endpush
@extends('layouts/contentNavbarLayout')

@section('title', 'History')
@section('nav-title', "Patient History")

@section('content')
<style type="text/css">
  td, th{
    text-align:center!important;
  }
</style>
<!-- Bootstrap Table with Header - Dark -->
<div class="card">
  <h4 class="card-header">{{ Auth::user()->name }}'s Patient</h4>
  <hr>
  <div class="table-responsive text-nowrap px-5">
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
          <td>{{ \Carbon\Carbon::parse($examination->appointment->start_date_time)->format('l, F j, Y g:i A') }}</td>
          <td>{{ $examination->service->name }}</td>
          <td>{{ $examination->price }}</td>
          <td class="text-center">
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">
                  {{-- <i class="bx bx-edit-alt me-1"></i> --}}
                 Something</a>
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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
    var $jq = $.noConflict(true);
    $jq(document).ready(function() {
        $jq('#datatable').DataTable();
    });
</script>
@endpush
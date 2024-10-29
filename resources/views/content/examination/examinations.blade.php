@extends('layouts/contentNavbarLayout')

@section('title', 'Examinations')
@section('nav-title', 'Examinations')

@section('content')

<!-- Bootstrap Table with Header - Dark -->
<div class="card p-5">
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
<style type="text/css">
    td, th {
        text-align:center!important;
    }
</style>
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
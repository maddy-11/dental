@extends('layouts/contentNavbarLayout')

@section('title', 'Pending Payments')
@section('nav-title', 'Pending Payments')

@section('content')
<style type="text/css">
  td, th{
    text-align:center!important;
  }
  .form-input{
    display: block;
    padding: .543rem .9375rem;
    font-size: .9375rem;
    font-weight: 400;
    line-height: 1.375;
    color: #384551;
    background-color: transparent;
    border: var(--bs-border-width) solid #ced1d5;
    border-radius: var(--bs-border-radius);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  }
</style>

<div class="card">
  <div class="d-flex justify-content-between align-items-center pe-3">
    <h4 class="p-2 m-0">{{ $user->name }}'s Salary</h4>
    @if(Auth::user()->is_admin)
    <span class="btn btn-primary paymentModalBtn text-nowrap" data-payment_id="{{$user->id}}" data-payment_amount="{{ $totalPendingSalary }}">Pay Now</span>
    @endif
  </div>
  <!-- Date Range Filter -->
  <div class="container-fluid row justify-content-between align-items-center p-3 m-auto" style="background: ghostwhite;">
    <div class="col-md-5 row m-auto">
    <div class="mb-2 mb-md-0 col-md-8">
        <input type="text" id="dateRangePicker" class="form-control bg-light text-dark" placeholder="Select Date Range">
    </div>
    <div class="mt-2 mt-md-0 col-md-4">
        <button class="btn btn-primary w-100 w-md-auto" id="filterBtn">Filter</button>
    </div>
    </div>

    <!-- Label and Input Pairs -->
    <div class="col-md-7">
    <div class="d-flex flex-column flex-md-row align-items-center gap-3 mt-2 mt-md-0">
        <div class="row align-items-center container">
            <label class="col-md-5 col-5 text-nowrap mb-1 mb-sm-0 me-sm-2">Total Pending</label>
            <input class="col-md-5 col text-center justify-content-between p-2 bg-light border rounded" value="{{ $totalPendingSalary }}" readonly>
        </div>
        <div class="row align-items-center justify-content-between container">
            <label class="col-md-5 col-5 text-nowrap mb-1 mb-sm-0 me-sm-2">Total Paid</label>
            <input class="col-md-5 col text-center p-2 bg-light border rounded" value="{{ $total_paid }}" readonly>
        </div>
    </div>
  </div>
</div>




  <ul class="nav nav-tabs" id="tabSection1" role="tablist">
    <li class="nav-item col-lg-6 btn" role="presentation">
      <a class="nav-link active" id="home-tab1" data-bs-toggle="tab" href="#pending_salary" role="tab" aria-controls="home" aria-selected="true">Total Payments</a>
    </li>
    <li class="nav-item col-lg-6 btn" role="presentation">
      <a class="nav-link" id="profile-tab1" data-bs-toggle="tab" href="#paid-salary" role="tab" aria-controls="profile" aria-selected="false">Paid Payments</a>
    </li>
  </ul>
{{-- <div class="container">
  <div class="d-flex flex-column flex-md-row align-items-center gap-3 mt-2 mt-md-0">
        <div class="row align-items-center container">
            <label class="col-md-5 col-5 text-nowrap mb-1 mb-sm-0 me-sm-2">Total Pending</label>
            <input class="col-md-5 col text-center justify-content-between p-2 bg-light border rounded" value="{{ $totalPendingSalary }}" readonly>
        </div>
        <div class="row align-items-center justify-content-between container">
            <label class="col-md-5 col-5 text-nowrap mb-1 mb-sm-0 me-sm-2">Total Paid</label>
            <input class="col-md-5 col text-center p-2 bg-light border rounded" value="{{ $total_paid }}" readonly>
        </div>
    </div>
</div> --}}
  <div class="tab-content" id="tabContent1">
    <!-- Pending Salary Table -->
    <div class="tab-pane fade show active" id="pending_salary" role="tabpanel" aria-labelledby="home-tab1">
      <div class="table-responsive text-nowrap">
        <table class="table datatable" id="pendingSalaryTable">
          <thead class="table-dark">
            <tr>
              <th>Salary / Payments</th>
              <th>Month / Appointment Date</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0" id="pendingSalaries">
            <!-- AJAX will populate rows here -->
          </tbody>
        </table>
      </div>
    </div>

    <!-- Paid Salary Table -->
    <div class="tab-pane fade" id="paid-salary" role="tabpanel" aria-labelledby="profile-tab1">
      <div class="table-responsive text-nowrap">
        <table class="table datatable" id="paidSalaryTable">
          <thead class="table-dark">
            <tr>
              <th>Paid Amount</th>
              <th>Payment Date</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0" id="paidSalaries">
            <!-- AJAX will populate rows here -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Payment Modal Code Remains the Same -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enter Amount</h5>
        <button id="manualCloseButton" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="totalPendingAmount">Total Pending Amount</label>
          <input type="text" class="form-control" id="totalPendingAmount" value="1000" readonly>
        </div>
        <div class="form-group">
          <label for="enterAmount">Enter Amount</label>
          <div class="row justify-content-around">
            <input type="number" class="form-input col-md-8" id="enterAmount" placeholder="Enter amount">
            <input type="hidden" id="payment_id_input">
            <button type="button" id="payBtn" class="btn btn-primary col-lg-3">Total</button>
          </div>
        </div>
        <button type="submit" class="btn btn-primary form-control mt-3 pay_save">Pay Now</button>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@endsection

@push('page-scripts')

<script type="text/javascript">
  $(document).on('click','.paymentModalBtn', function() {
   let amount = $(this).data('payment_amount');
   $('#totalPendingAmount').val(amount);
   $('#paymentModal').modal('show');
 });

  $('#manualCloseButton').on('click', function() {
    $('#paymentModal').modal('hide');
  });

  $('#payBtn').on('click',function(){
    $('#enterAmount').val($('#totalPendingAmount').val())
  });
  $('.pay_save').on('click', function(e){
    e.preventDefault()
    $.ajax({
      url: '{{ route('pending_payments.pay', ['id'=>$user->id]) }}',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      data: {
        'amount': $('#enterAmount').val()
      },
      success: function(response){
        alert('Payment Updated Successfully');
        location.reload();
      },
      error: function(response){
        alert('Payment Failed');
      }
    });
  });
</script>

<script>
  jQuery(document).ready(function($) {

    $(function() {

      var start = moment().startOf('month');
      var end = moment();

      function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }

      $('#dateRangePicker').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
         'Today': [moment(), moment()],
         'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
         'Last 7 Days': [moment().subtract(6, 'days'), moment()],
         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
         // 'This Month': [moment().startOf('month'), moment().endOf('month')],
          'This Month': [moment().startOf('month'), moment()],
         'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
       }
     }, cb);

      cb(start, end);

    });

    // Fetch and filter salary data via AJAX
    function fetchSalaries(startDate, endDate) {
      $.ajax({
        url: "{{ route('payments.filter', ['id' => $user->id]) }}",
        type: 'GET',
        data: {
          start_date: startDate,
          end_date: endDate
        },
        success: function(response) {
          $('#pendingSalaries').html(response.pending_html);
          $('#paidSalaries').html(response.paid_html);
        }
      });
    }

    // Apply the filter on button click
    $('#filterBtn').on('click', function() {
      let dateRange = $('#dateRangePicker').val().split(' - ');
      let startDate = dateRange[0];
      let endDate = dateRange[1];

      fetchSalaries(startDate, endDate);
    });

    
    var start = moment().startOf('month');
    var end = moment();
    fetchSalaries(start.format('MM/DD/YYYY'), end.format('MM/DD/YYYY'));
  });
</script>
@endpush

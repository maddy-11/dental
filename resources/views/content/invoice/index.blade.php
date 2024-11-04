@extends('layouts/contentNavbarLayout')

@section('title', 'Payments')
@section('nav-title', 'Payments')

@section('content')
<style type="text/css">
  td, th{
    text-align:center !important;
}
</style>
<!-- Bootstrap Table with Header - Dark -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center pe-3">
        <h4 class="p-2 m-0">All Payments</h4>
    </div>

    <!-- Date Range Picker -->
    <div class="d-flex justify-content-between align-items-center p-3" style="background: ghostwhite;">
        <div class="col-md-4">
            <input type="text" id="dateRangePicker" class="form-control bg-light text-dark" placeholder="Select Date Range">
      </div>
      <button class="btn btn-primary" id="filterBtn">Filter</button>
  </div>


  <div class="table-responsive text-nowrap px-5">
    <table class="table datatable" id="paymentsTable">
        <thead class="table-dark">
            <tr>
                <th>Patient</th>
                <th class="text-center">Doctor</th>
                <th>Service</th>
                <th>Appointment Date</th>
                <th>Amount</th>
                <th>View All</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <!-- Data will be populated by AJAX -->
        </tbody>
    </table>
</div>
</div>

<style>
    .btnSuccess {
        background: #184301 !important;
    }
    th, th{
        text-align:center !important;
    }
</style>

@endsection

@push('page-scripts')
<script>
    jQuery(document).ready(function($) {
        var table = $('#paymentsTable').DataTable({
        processing: true,
        language: {
            processing: "<div class='loader'>Loading...</div>"
        },
        destroy: true
    });
        
        // Date range picker initialization
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
             'This Month': [moment().startOf('month'), moment()],
             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         }
     }, cb);

        // Set initial date range display
        cb(start, end);

        // Event listener for filter button
        $('#filterBtn').on('click', function() {
            let dateRange = $('#dateRangePicker').val().split(' - ');
            let startDate = dateRange[0];
            let endDate = dateRange[1];

            fetchPayments(startDate, endDate);
        });

        // Initial fetch call with default dates
        fetchPayments(start.format('MM/DD/YYYY'), end.format('MM/DD/YYYY'));

        // Function to fetch payments
        function fetchPayments(startDate, endDate) {
            $.ajax({
                url: '{{ route("payments.fetch") }}', // Define your route here
                method: 'GET',
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(data) {
                  console.log(data);
                  table.clear().draw();
                  $.each(data, function(index, payment) {
                    table.row.add([
                        payment.appointment.name,
                        payment.appointment.user.name,
                        payment.appointment.service.name,
                        payment.appointment.start_date_time,
                        '<span class="bg-success rounded text-white btn btnSuccess">' + payment.payments_sum_amount + '</span>',
                        '<a class="btn btn-primary" href="{{ url('portal/payments/details/') }}/' + payment.id + '">View All</a>',
                        '<div class="dropdown">' +
                        '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                        '<i class="bx bx-dots-vertical-rounded"></i></button>' +
                        '<div class="dropdown-menu">' +
                            // '<a class="dropdown-item" href="{{ url('payments/receipt') }}/' + payment.id + '"><i class="bx bx-edit-alt me-1"></i> View Receipt</a>' +
                        '<a class="dropdown-item" href="{{ url('payments/delete') }}/' + payment.id + '"><i class="bx bx-trash me-1"></i> Delete</a>' +
                        '</div></div>'
                        ]).draw();
                });
              },
              error: function(xhr, status, error) {
                console.error(xhr);
                alert('An error occurred while fetching payments.');
            }
        });
        }
    });
</script>

@endpush

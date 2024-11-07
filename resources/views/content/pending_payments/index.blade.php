@extends('layouts/contentNavbarLayout')
@section('title', 'Pending Payments')
@section('nav-title', 'Pending Payments')

@section('content')
<style type="text/css">
td,
th {
    text-align: center !important;
}

.form-input {
    display: block;
    padding: .543rem .9375rem;
    font-size: .9375rem;
    font-weight: 400;
    line-height: 1.375;
    color: #384551;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent;
    background-clip: padding-box;
    border: var(--bs-border-width) solid #ced1d5;
    border-radius: var(--bs-border-radius);
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}

</style>
<div class="card">
  <div class="d-flex justify-content-between align-items-center pe-3">
    <h4 class="p-2 m-0">Pending Salaries</h4>
  </div>
  <div class="d-flex justify-content-between align-items-center p-3" style="background: ghostwhite;">
    <div class="col-md-4">
      <input type="text" id="dateRangePicker" class="form-control bg-light text-dark" placeholder="Select Date Range">
    </div>
    <button class="btn btn-primary" id="filterBtn">Filter</button>
  </div>
  <ul class="nav nav-tabs" id="tabSection1" role="tablist">
    <li class="nav-item col-md-6" role="presentation">
      <a class="nav-link active" id="home-tab1" data-bs-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="false">Fixed Salaries</a>
    </li>
    <li class="nav-item col-md-6" role="presentation">
      <a class="nav-link" id="profile-tab1" data-bs-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-selected="true">Percentage Salaries</a>
    </li>
  </ul>
  <div class="tab-content" id="tabContent1">
    <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab1">

      {{-- Fixed Salaries --}}

      <div>
        <div class="table-responsive text-nowrap">
          <table class="table datatable" id="fixedPaymentsTable">
            <!-- Table structure remains the same -->
            <thead class="table-dark">
              <tr>
                <th>Doctor</th>
                <th>Pending Payment</th>
                <th>Paid Salary</th>
                <th>Details</th>
                <th>Pay Now</th>
                {{-- <th class="text-center">Actions</th> --}}
              </tr>
            </thead>
            <tbody class="table-border-bottom-0"></tbody>
          </table>
        </div>
      </div>
    </div>

    {{-- // percentage salaries --}}

    <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab1">
      <div>
        <div class="table-responsive text-nowrap">
          <table class="table datatable" id="percentagePaymentsTable">
            <!-- Table structure remains the same -->
            <thead class="table-dark">
              <tr>
                <th>Doctor</th>
                <th>Pending Amount</th>
                <th>Paid Amount</th>
                <th>View</th>
                <th>Pay Now</th>
                {{-- <th class="text-center">Actions</th> --}}
              </tr>
            </thead>
            <tbody class="table-border-bottom-0"></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Payment Modal -->
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
@endsection
@push('page-scripts')
<script type="text/javascript">
$(document).on('click', '.paymentModalBtn', function () {
    let amount = $(this).data('payment_amount');
    let paymentId = $(this).data('payment_id');
    $('#payment_id_input').val(paymentId);
    $('#totalPendingAmount').val(amount);
    $('#paymentModal').modal('show');
});

$('#manualCloseButton').on('click', function () {
    $('#paymentModal').modal('hide');
});

$('#payBtn').on('click', function () {
    $('#enterAmount').val($('#totalPendingAmount').val())
});

// -------------------
$('.pay_save').on('click', function (e) {
    e.preventDefault()
    let id = $('#payment_id_input').val();
    let paymentUrl = '{{ route('pending_payments.pay', ['id'=>':id ']) }}';
    paymentUrl = paymentUrl.replace(':id', id);
    $.ajax({
        url: paymentUrl,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            'amount': $('#enterAmount').val()
        },
        success: function (response) {
            alert('Payment Updated Successfully');
            location.reload();
        },
        error: function (response) {
            alert('Payment Failed');
        }
    });
});

</script>

<script>
jQuery(document).ready(function ($) {

    $('#filterBtn').on('click', function () {
        let dateRange = $('#dateRangePicker').val().split(' - ');
        let startDate = dateRange[0];
        let endDate = dateRange[1];

        fetchSalaries(startDate, endDate);
    });

    var start = moment().subtract(29, 'days');
    var end = moment();
    fetchSalaries(start.format('MM/DD/YYYY'), end.format('MM/DD/YYYY'));

    function fetchSalaries(startDate, endDate) {
        $.ajax({
            url: "{{ route('pending_payments.index') }}",
            type: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function (response) {
                updateTable('#fixedPaymentsTable tbody', response.fixedPayments);
                updateTable('#percentagePaymentsTable tbody', response.percentagePayments);
            }
        });
    }

    function updateTable(tableBodySelector, payments) {
        let tableBody = $(tableBodySelector);
        tableBody.empty();

        if (payments.length > 0) {
            const baseUrl = "{{ route('pending_payments.pending.get', ['id' => '__DOCTOR_ID__']) }}";
            payments.forEach(function (payment) {
                const doctorUrl = baseUrl.replace('__DOCTOR_ID__', payment.doctor.id);
                tableBody.append(`
            <tr>
                <td>${payment.doctor.name}</td>
                <td>${payment.total_pending_salary - payment.total_paid_salary}</td>
                <td>${payment.total_paid_salary ?? 0}</td>
                <td>
                    <a href="${doctorUrl}" class="btn btn-dark">Details</a>
                </td>
                <td>
                    <span class="btn btn-primary paymentModalBtn" data-payment_id="${payment.doctor.id}" data-payment_amount="${payment.total_pending_salary - payment.total_paid_salary}">
                        Pay Now
                    </span>
                </td>
            </tr>
            `);
            });
        } else {
            tableBody.append('<tr><td colspan="6">No payments found for the selected date range.</td></tr>');
        }
    }

    $(function () {

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

        cb(start, end);

    });

});

</script>
@endpush

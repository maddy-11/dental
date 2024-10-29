@extends('layouts/contentNavbarLayout')

@section('title', 'Book An Appointment')
@section('nav-title', 'Appointments')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="container bg-white py-5 rounded" data-aos="fade-up" data-aos-delay="100">
  <h3>Book An Appointment</h3>
  <hr>

  <form action="{{ route('appointments.store') }}" method="post" role="form" class="php-email-form">
    @csrf
    <div class="row">
      <div class="col-md-6 form-group">
        <select id="patient" name="patient_id" class="form-select" required="">
          <option selected disabled>Select Patient</option>
          @foreach($patients as $patient)
          <option data-phone="{{ $patient->phone }}" value="{{ $patient->id }}">#{{ $patient->registration_id }} - {{ $patient->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-md-6 form-group mt-3 mt-md-0">
        <input type="tel" class="form-control bg-light" name="phone" id="phone" placeholder="Patient's Phone" required="" readonly>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 form-group mt-3">
        <input type="text" name="date" class="form-control datepicker" id="date" placeholder="Pick a Date" required>
      </div>
      <div class="col-md-3 form-group mt-3">
        <select id="time" name="time" class="form-select" required>
          <!-- Options will be populated by JavaScript -->
        </select>
      </div>

      <div class="col-md-3 form-group mt-3">
        <select name="service_id" id="service" class="form-select" required="">
          <option selected disabled>Select Service</option>
          @foreach($services as $service)
          <option value="{{ $service->id }}">{{ $service->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3 form-group mt-3">
        <select name="user_id" id="doctor" class="form-select" required="">
          <option selected disabled>Select Doctor</option>
          @foreach($doctors as $doctor)
          <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group mt-3">
      <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
    </div>
    <div class="mt-3">
      <div class="text-center"><button class="btn btn-primary rounded px-5" type="submit">Make an Appointment</button></div>
    </div>
  </form>

</div>
@endsection

@push('page-scripts')
<script>
  jQuery(document).ready(function($) {
  $('#patient').select2({
            width: '100%',
        });
});
  document.addEventListener('DOMContentLoaded', () => {
    const timeSelect = document.getElementById('time');
    let start_time = '{{ $timings->start_time }}';
    let end_time = '{{ $timings->end_time }}';
    // Function to format time to 12-hour clock with AM/PM
    function formatTimeTo12Hour(hours) {
      const period = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12; // Convert to 12-hour format
      return `${hours} ${period}`;
    }

    // Function to generate time options
    function generateTimeOptions() {
      for (let hours = parseInt(start_time); hours <= parseInt(end_time); hours++) {
        const value = `${('0' + hours).slice(-2)}:00`;
        const text = formatTimeTo12Hour(hours);
        const option = new Option(text, value);
        timeSelect.add(option);
      }
    }

    generateTimeOptions();
  });
  document.addEventListener('DOMContentLoaded', () => {
    flatpickr('#date', {
      dateFormat: 'F j, Y',
      altInput: true,
      altFormat: 'F j, Y',
      minDate: 'today'
    });
  });

  $('#patient').on('change', function(){
    var selectedOption = $(this).find('option:selected');
    $('#phone').val(selectedOption.data('phone'))
  });
</script>
@endpush
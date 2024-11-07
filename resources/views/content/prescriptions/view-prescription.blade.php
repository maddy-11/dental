<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <p class="text-center text-danger">Save First to View Changes</p>
      <hr class="pt-0 mt-0">
    <div class="d-flex align-items-center justify-content-between">
        <header style="text-align: center; flex-grow: 1;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path_image($horizontalLogo))) }}" style="display: block; margin: auto; width: 250px; object-fit: contain;">
            <p style="width:70%; margin:auto">{!! $address !!}</p>
            <p>Phone: {{$clinic_phone}}</p>
        </header>
        <div style="flex-shrink: 0;">
            {{ $qrCode }}
        </div>
    </div>

    <div class="modal-body">
        <div class="patient-info">
          {{-- <p><strong>Patient Name:</strong> {{ $appointment->name }}</p>
          <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->start_date_time)->format('F j, Y') }}</p> --}}
          <table class="patient-info table">
            <thead>
              <tr>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Visit Date</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>#{{ $appointment->patient->registration_id }}</td>
            <td>{{ $appointment->name }}</td>
            <td>{{ \Carbon\Carbon::parse($appointment->start_date_time)->format('F j, Y') }}</td>
        </tr>
    </tbody>
</table>
</div>

<div class="prescription-details">
  <table class="table">
    <tr>
      <td style="width: 66.6%; vertical-align: top; border:none!important;border-right: solid #dbd9d9 1px !important;">
        <h2 class="mb-0">Rx Or Prescription</h2>
        <div class="table-responsive">
          <table class="medication-table table">
            <thead>
              <tr>
                <th>Medication</th>
                <th>Dosage</th>
                <th>Duration</th>
                <th>Frequency</th>
            </tr>
        </thead>
        <tbody>
          @foreach($prescriptions as $prescription)
          @php
          $prescription->details = json_decode($prescription->details, true);
          @endphp
          <tr>
            <td>{{ $prescription->medicine->medicine }}</td>
            <td>{{ $prescription->medicine->dosage }}</td>
            <td>{{$prescription->details['duration'] }} {{ $prescription->details['time_unit']}}</td>
            <td>{{$prescription->details['daily_dosage']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</td>
<td style="width: 25%; vertical-align: top; border: none!important;">
    <h2 class="mb-0">Procedures</h2>
    <div class="table-responsive">
      <table class="medication-table table">
        <tbody>
          @foreach($examinations as $examination)
          <tr>
            <td style="white-space: nowrap;">{{ $examination->service->name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</td>
</tr>
</table>
</div>
</div>
<div class="modal-footer d-flex justify-content-between">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="button" id="downloadPdfButton" class="btn btn-primary">Save PDF</button>
</div>
</div>
</div>
</div>

<style>
    {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

/* Modal Custom Styles */
.modal-content {
    border-radius: 8px;
    padding: 20px;
}

/* Modal Header */
.modal-header {
    border-bottom: 1px solid #e5e5e5;
}

.modal-title {
    font-size: 24px;
    color: #333;
}

.btn-close {
    background: none;
    border: none;
    background-repeat: no-repeat !important;
    background-position: center !important;
}

/* Clinic Header Information */
header {
    text-align: center;
    margin-bottom: 20px;
}

header p {
    font-size: 14px;
    color: #555;
}

/* Patient Information Section */
.patient-info p {
    font-size: 16px;
    color: #333;
    margin: 5px 0;
}

/* Prescription Details Section */
.prescription-details {
    margin-top: 20px;
}

.prescription-details h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
}

/* Prescription Table Styling */
.medication-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.medication-table th,
.medication-table td {
    padding: 12px;
    text-align: left;
    font-size: 16px;
}

.medication-table th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #333;
    border-bottom: 2px solid #ddd;
}

.medication-table td {
    color: #555;
    border-bottom: 1px solid #e0e0e0;
}

.medication-table tbody tr:hover {
    background-color: #f1f8ff;
}

/* Modal Footer */
.modal-footer {
    border-top: 1px solid #e5e5e5;
    padding-top: 15px;
}

.modal-footer .btn {
    min-width: 100px;
}

/* Print Styling */
@media print {
    @page {
        size: A4;
        margin: 10mm;
    }

    .modal-content {
        border: none;
        box-shadow: none;
        width: 100%;
        /* Ensure it uses the full width */
        height: auto;
        /* Allow auto height for content */
    }

    header,
    .patient-info,
    .prescription-details {
        page-break-inside: avoid;
    }

    .medication-table th,
    .medication-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .modal-footer,
    .btn-close {
        display: none;
        /* Hide elements that are unnecessary for printing */
    }
}

</style>
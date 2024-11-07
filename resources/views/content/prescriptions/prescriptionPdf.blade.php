<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prescription</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
</head>

<body>
  <div class="prescription-page">
    <table style="width: 100%; border-collapse: collapse;">
    <tr>
        <!-- Left Cell: Logo, Address, and Phone -->
        <td style="text-align: center; vertical-align: middle; width: 70%;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path_image($horizontalLogo))) }}" style="display: block; margin: auto; width: 200px; height: auto; object-fit: contain;">
            <p style="width: 85%; margin: auto;color: #666;">{!! $address !!}</p>
            <p style="color: #666;">Phone: {{$clinic_phone}}</p>
        </td>
        
        <!-- Right Cell: QR Code -->
        <td style="text-align: center; vertical-align: middle; width: 30%;">
            <div id="qrcode" style="display: inline-block;"></div>
            <img src="data:image/svg+xml;base64,{{ $qrCodeImg }}" alt="QR Code" style="display: block; margin: auto; width: 100px; height: 100px; object-fit: contain;">
        </td>
    </tr>
</table>


    <div class="patient-info">
      {{-- <p><strong>Patient Name:</strong> {{ $appointment->name }}</p>
      <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->start_date_time)->format('F j, Y') }}</p> --}}
      <table class="medication-table patient-info" width="100%">
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
      <table width="100%">
        <tr>
          <td style="width: 66.66%!important; vertical-align: top; border-right: solid #dbd9d9 1px !important;">
            <h2>Rx Or Prescription</h2>
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
          <td style="width: 33.33%!important; vertical-align: top;">
            <h2>Procedures</h2>
            <div class="table-responsive">
              <table class="medication-table table">
                <tbody>
                  @foreach($examinations as $examination)
                  <tr>
                    <td>{{ $examination->service->name }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </td>
        </tr>
      </table>
    </div>

    <footer>
      <p>Thank you for choosing our clinic. Get well soon!</p>
    </footer>
  </div>
</body>

</html>
<style>

/* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Page setup */
body {
    font-family: 'Arial', sans-serif;
    font-family: font-family: my_custom_font!important;
    background-color: #fff;
    padding: 0;
}

.prescription-page {
    width: 100%;
    height: 100vh;
    /* Full height for printing */
    background: #fff;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border: 1px solid #ddd;
    font-family: font-family: my_custom_font!important;
}

/* Header Styling */
header {
    text-align: center;
    margin-bottom: 20px;
}

header h1 {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
    font-family: font-family: my_custom_font!important;
}

header p {
    font-size: 14px;
    color: #666;
    font-family: font-family: my_custom_font!important;
}

/* Patient Information Section */
.patient-info {
    margin-top: 20px;
    padding-bottom: 12px;
    margin-bottom: 20px;
    font-family: font-family: my_custom_font!important;
}

.patient-info p {
    font-size: 16px;
    color: #444;
    margin-bottom: 8px;
}

/* Prescription Details Section */
.prescription-details {
    padding: 20px 0;
}

.prescription-details h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
    font-family: 'Montserrat', sans-serif !important;
}

/* Prescription Table Styling */
.medication-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.medication-table th,
.medication-table td {
    padding: 12px 15px;
    text-align: left;
    font-size: 16px;
    color: #333;
    font-family: font-family: my_custom_font!important;
}

.medication-table th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #555;
    border-bottom: 2px solid #ddd;
    font-family: font-family: my_custom_font!important;
}

.medication-table tbody tr {
    border-radius: 6px;
    background-color: #fafafa;
    transition: background-color 0.2s ease;
    font-family: font-family: my_custom_font!important;
}

.medication-table tbody tr:hover {
    background-color: #f1f8ff;
}

.medication-table tbody tr+tr {
    border-top: 1px solid #eee;
}

.medication-table td {
    color: #555;
}

/* Footer */
footer {
    text-align: center;
    margin-top: 25px;
    font-size: 14px;
    color: #888;
}

footer p {
    margin: 5px 0;
    font-family: font-family: my_custom_font!important;
}

/* Print Styling */
@media print {
    @page {
        size: A4;
        /* Change to A4 or letter size */
        margin: 0;
        /* No margin */
    }

    body {
        padding: 0;
        background: none;
    }

    .prescription-page {
        border: none;
        box-shadow: none;
        width: 100%;
        /* Ensure it uses the full width */
        height: auto;
        /* Allow auto height for content */
    }

    .medication-table th,
    .medication-table td {
        border: 1px solid #ddd;
    }

    header,
    .patient-info,
    .prescription-details,
    footer {
        page-break-inside: avoid;
    }
}

</style>
@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script>
    var url = "{{ Request::root() }}";
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: url,
        width: 128,
        height: 128,
        render: "canvas", // Using canvas for easier base64 conversion
    });

    // Convert the QR Code canvas to base64 image
    function getQRCodeBase64() {
        var canvas = document.querySelector("#qrcode canvas"); // Select the canvas element
        var base64Image = canvas.toDataURL("image/png"); // Convert canvas to base64 PNG
        document.getElementById("qrcodeBase64").value = base64Image; // Store base64 string in hidden input
    }

    // Call the function to get the base64 string after QR code is rendered
    qrcode.makeCode(url); // Ensure QR code is created
    getQRCodeBase64(); // Get base64 encoded QR code
</script>
@endpush
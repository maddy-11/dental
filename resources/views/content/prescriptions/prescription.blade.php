@extends('layouts/contentNavbarLayout')

@section('title', 'Prescription')

@section('content')
<div class="col-10 m-auto p-3">
    <div class="d-flex">
        <button onclick="goBack()" class="btn btn-secondary me-3 ms-auto">Back</button>
        <a href="javascript:void(0)" id="downloadPdfButton" class="btn btn-primary me-3">Download PDF</a>
    </div>
</div>
<div class="prescription-page">
    <div class="d-flex align-items-center justify-content-between">
        <header style="text-align: center; flex-grow: 1;">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path_image($horizontalLogo))) }}" style="display: block; margin: auto; width: 250px; object-fit: contain;">
            <p style="width:70%; margin:auto">{!! $address !!}</p>
            <p>Phone: {{$clinic_phone}}</p>
        </header>
        <div style="flex-shrink: 0;">
            <img src="data:image/svg+xml;base64,{{ $qrCodeImg }}" alt="QR Code" style="display: block; margin: auto; width: 100px; height: 100px; object-fit: contain;">
        </div>
    </div>
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
                <td style="width: 66.6%; vertical-align: top; border-right: solid #dbd9d9 1px !important;">
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
                <td style="width: 25%; vertical-align: top;">
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
    background-color: #fff;
    padding: 0;
}

.prescription-page {
    width: 80%;
    margin:auto;
    background: #fff;
    border-radius: 8px;
    padding: 25px;
/*    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);*/
border: 1px solid #ddd;
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
}

header p {
    font-size: 14px;
    color: #666;
}

/* Patient Information Section */
.patient-info {
    margin-top:100px;
    padding-bottom: 12px;
    margin-bottom: 20px;
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
    font-size: 22px;
    color: #333;
    margin-bottom: 15px;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
}

/* Prescription Table Styling */
.medication-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

.medication-table th, .medication-table td {
    padding: 12px 15px;
    text-align: left;
    font-size: 16px;
    color: #333;
}

.medication-table th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #555;
    border-bottom: 2px solid #ddd;
}

.medication-table tbody tr {
    border-radius: 6px;
    background-color: #fafafa;
    transition: background-color 0.2s ease;
}

.medication-table tbody tr:hover {
    background-color: #f1f8ff;
}

.medication-table tbody tr + tr {
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
}

/* Print Styling */
@media print {
    @page {
        size: A4; /* Change to A4 or letter size */
        margin: 0; /* No margin */
    }

    body {
        padding: 0;
        background: none;
    }

    .prescription-page {
        border: none;
        box-shadow: none;
        width: 100%; /* Ensure it uses the full width */
        height: auto; /* Allow auto height for content */
    }

    .medication-table th, .medication-table td {
        border: 1px solid #ddd;
    }

    header, .patient-info, .prescription-details, footer {
        page-break-inside: avoid;
    }
}
</style>
@endsection

@push('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script type="text/javascript">
    $('#downloadPdfButton').click(function() {
        Swal.fire({
            title: 'Loading...',
            text: 'Generating your PDF, please wait.',
            allowOutsideClick: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
        $.ajax({
            url: '{{ route('prescription.download', ['id'=>$appointment->id])}}',
            method: 'GET',
            success: function(response) {
                const blob = new Blob([data], { type: 'application/pdf' });
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'document.pdf';
                document.body.appendChild(link);
                link.click();
                setTimeout(() => {
                    document.body.removeChild(link);
                    window.URL.revokeObjectURL(link.href);
                }, 100);
            },
            complete: function () {
               Swal.close();
           }
       });
    });

    function goBack() {
        window.history.back();
    }
    var url = "{{ Request::root() }}";
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: url,
        width: 128,
        height: 128,
    });
</script>
@endpush
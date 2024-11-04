<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="prescription-page">
        <header>
            <h1>Mansha's Dental Clinic</h1>
            <p>Address: Afaq Plaza, Peshawar Road, Charsadda</p>
            <p>Phone: (555) 123-4567</p>
        </header>

        <div class="patient-info">
            <p><strong>Patient Name:</strong> {{ $appointment->name }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->start_date_time)->format('F j, Y') }}</p>
        </div>

        <div class="prescription-details">
            <h2>Prescription</h2>
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
    background-color: #fff;
    padding: 0;
}

.prescription-page {
    width: 100%;
    height: 100vh; /* Full height for printing */
    background: #fff;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
    border-bottom: 1px solid #eee;
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
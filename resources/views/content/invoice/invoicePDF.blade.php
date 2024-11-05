<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&family=Montserrat:wght@200;400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Montserrat', sans-serif !important;
    }

    .inner-container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background: #fff;
    }

    header.top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    h2{
      font-family: 'Montserrat', sans-serif !important;
    }
    header.top-bar h1 {
      font-family: 'Montserrat', sans-serif !important;
    }

    .button {
      padding: 10px 20px;
      margin: 5px;
      text-decoration: none;
      color: #fff;
      background: #1779ba;
      border-radius: 5px;
    }

    .button.secondary {
      background: #6c757d;
    }

    .invoice-container {
      padding: 20px;
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    table.invoice {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table.invoice th, table.invoice td {
      padding: 15px;
    }

    .invoice .header img {
      max-width: 300px;
    }

    .invoice .header h2 {
      text-align: right;
      font-weight: 200;
      font-size: 2rem;
      color: #1779ba;
    }

    .invoice .intro td {
      padding: 10px 0;
    }

    .invoice .intro td:nth-child(2) {
      text-align: right;
    }

    .invoice .details table {
      width: 100%;
      border-collapse: collapse;
    }

    .invoice .details th, .invoice .details td {
      padding: 10px;
      border: 1px solid #ddd;
      color:#444444 !important;
      text-align: left;
    }

    .invoice .totals {
      margin-top: 20px;
    }

    .invoice .totals table {
      width: 100%;
      border-collapse: collapse;
    }

    .invoice .totals td {
      padding: 10px;
    }

    .invoice .totals tr.total td {
      font-size: 1.2em;
      font-weight: 700;
    }

    .additional-info {
      margin-top: 20px;
    }

    .additional-info h5 {
      font-size: .8em;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: #1779ba;
    }

    .additional-info p {
      margin: 5px 0;
    }
  </style>
</head>
<body>
  <div class="inner-container">
    <section class="invoice-container">
      <table class="invoice">
        <tr class="header">
          <td>
            <h3 style="font-family: 'Montserrat', sans-serif;">{{ $brandName }}</h3>
          </td>
          <td class="align-right">
            <h2 style="font-weight: 500; font-family: 'Montserrat', sans-serif;">Invoice</h2>
          </td>
        </tr>
        <tr class="intro">
          <td>
            Hello, {{ $patient->name }}.<br>
            Thank you for visiting Us.
          </td>
          <td class="text-right">
            <span>
              {{ \Carbon\Carbon::parse($invoice->appointment->start_date_time)->format('l, F j, Y g:i A') }}
            </span>
          </td>
        </tr>
        <tr class="details">
          <td colspan="2" style="border:none">
            <table>
              <thead>
                <tr>
                  <th class="desc">Procedure</th>
                  <th class="id">Doctor</th>
                  <th class="amt">Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach($payments as $payment)
                <tr class="item">
                  <td class="desc">{{ $payment->examination->service->name }}</td>
                  <td class="desc">{{ $payment->examination->doctor->name }}</td>
                  <td class="desc">{{ $payment->amount }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </td>
        </tr>
        <tr class="totals">
          <td></td>
          <td>
            <table>
              <tr class="subtotal">
                <td class="num">Subtotal</td>
                <td class="num">{{ $invoice->payments_sum_amount }}</td>
              </tr>
              <tr class="tax">
                <td class="num">Tax and Others</td>
                <td class="num">0.00</td>
              </tr>
              <tr class="total">
                <td>Total</td>
                <td class="num">{{ $invoice->payments_sum_amount }}</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <section class="additional-info">
        <table style="width: 100%;">
          <tr>
            <td style="width: 50%; vertical-align: top;">
              <h5>Invoice From</h5>
              <p>
                {{ $brandName }}<br>
                {!! $address !!}
              </p>
            </td>
            <td style="width: 50%; vertical-align: top; text-align: center;">
              <h5>Patient Information</h5>
              <p>
                {{ $patient->name }}<br>
                {{ $patient->phone }}<br>
                {{ $patient->email }}<br>
              </p>
            </td>
          </tr>
        </table>
      </section>

    </section>
  </div>
</body>
</html>

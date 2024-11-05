@foreach($payments as $payment)
<tr>
    <td>{{ $payment->pending_salary }}</td>
    @if($user->salaryType != 'fix')
    <td>{{ $payment->examination->appointment->start_date_time ?? '' }}</td>
    @else
    <td>{{ $payment->month ?? '' }}</td>
    @endif
    <td class="text-center">
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('pending_payments.delete', ['id' => $payment->id]) }}">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </td>
</tr>
@endforeach

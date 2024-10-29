@foreach($paid as $payment)
<tr>
    <td>{{ $payment->paid_salary ?? 0 }}</td>
    <td>{{ $payment->created_at->format('F j, Y') }}</td>
    <td class="text-center">
        <div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('paid_payments.delete', ['id' => $payment->id]) }}">
                    <i class="bx bx-trash me-1"></i> Delete
                </a>
            </div>
        </div>
    </td>
</tr>
@endforeach

<span class="sub-text">{{ __('Rent')}}: {{ setting('currency_symbol') . ' ' . number_format($lease->rent, 2) }}</span>
@foreach($lease->bills as $bill)
    <span
        class="sub-text">{{ $bill->name }}: {{ setting('currency_symbol') . ' ' . number_format($bill->amount, 2) }}</span>

@endforeach
@if($lease->bills_sum_amount > 0)
    <span
        class="sub-text">{{ __('Total')}}: {{ setting('currency_symbol') . ' ' . number_format($lease->rent + $lease->bills_sum_amount, 2) }}</span>

@endif

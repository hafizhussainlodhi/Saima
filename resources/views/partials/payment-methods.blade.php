@php
$defaultPaymentList = [
    ['name' => 'Card', 'icon' => '/images/payments/card.png'],
    ['name' => 'Cheque', 'icon' => '/images/payments/cheque.png'],
    ['name' => 'Cash', 'icon' => '/images/payments/cash.png'],
    ['name' => 'Bitcoin', 'icon' => '/images/payments/bitcoin.png'],
];
$dbPaymentList = page_section('payment_methods', 'items', null);
if (!is_array($dbPaymentList) || empty($dbPaymentList)) {
    $dbPaymentList = $defaultPaymentList;
}
@endphp

<section id="payment" aria-label="Accepted Payment Methods for Real Estate" class="paymentSection">
    <div class="container">
        <div class="paymentHeader">
            <h2 class="paymentTitle">{{ page_section('payment_methods', 'heading', 'Hudayriyat Island Payment Methods') }}</h2>
            <p class="paymentSubtitle">{{ page_section('payment_methods', 'subtitle', 'We accept all the following payment methods') }}</p>
        </div>

        <div class="paymentGrid">
            @foreach($dbPaymentList as $item)
                @php
                    $iconSrc = $item['icon'] ?? '';
                    if ($iconSrc && !str_starts_with($iconSrc, 'http') && !str_starts_with($iconSrc, '/')) {
                        $iconSrc = asset($iconSrc);
                    }
                @endphp
                <div class="paymentCard">
                    <div class="paymentIconWrapper">
                        <img src="{{ $iconSrc }}" alt="{{ $item['name'] ?? '' }} payment method for Hudayriyat Island properties" width="50" height="50" class="paymentIcon">
                    </div>
                    <h3 class="paymentName">{{ $item['name'] ?? '' }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>

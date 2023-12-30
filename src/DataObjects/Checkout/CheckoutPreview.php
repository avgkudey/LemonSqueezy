<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class CheckoutPreview
{
    public function __construct(
        public string $currency,
        public int $currency_rate,
        public int $subtotal,
        public int $discount_total,
        public int $tax,
        public int $total,
        public int $subtotal_usd,
        public int $discount_total_usd,
        public int $tax_usd,
        public int $total_usd,
        public string $subtotal_formatted,
        public string $discount_total_formatted,
        public string $tax_formatted,
        public string $total_formatted,
    ) {}
}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class CheckoutPreview
{
    /**
     * @param string $currency
     * @param int $currency_rate
     * @param int $subtotal
     * @param int $discount_total
     * @param int $tax
     * @param int $total
     * @param int $subtotal_usd
     * @param int $discount_total_usd
     * @param int $tax_usd
     * @param int $total_usd
     * @param string $subtotal_formatted
     * @param string $discount_total_formatted
     * @param string $tax_formatted
     * @param string $total_formatted
     */
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

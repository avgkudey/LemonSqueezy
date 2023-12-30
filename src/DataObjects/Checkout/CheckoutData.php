<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class CheckoutData
{
    public function __construct(
        public string $email,
        public string|null $name,
        public CheckoutBillingAddress|null $billing_address,
        public string $tax_number,
        public string $discount_code,
        public array|null $custom,
        public array|null $variant_quantities,
    ) {}
}

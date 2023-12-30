<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class CheckoutData
{
    /**
     * @param string $email
     * @param string|null $name
     * @param CheckoutBillingAddress|null $billing_address
     * @param string $tax_number
     * @param string $discount_code
     * @param array|null $custom
     * @param array<int,array{
     *     variant_id:int,
     *     quantity:int
     * }>|null $variant_quantities
     */
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

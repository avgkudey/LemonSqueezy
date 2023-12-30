<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class CheckoutBillingAddress
{
    /**
     * @param string|null $country
     * @param string|null $zip
     */
    public function __construct(
        public string|null $country,
        public string|null $zip,
    ) {}
}

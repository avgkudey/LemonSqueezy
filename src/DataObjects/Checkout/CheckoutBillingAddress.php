<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class CheckoutBillingAddress
{
    public function __construct(
        public string|null $country,
        public string|null $zip,
    ) {}
}

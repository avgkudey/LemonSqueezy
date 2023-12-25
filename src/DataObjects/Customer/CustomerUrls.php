<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Customer;

final readonly class CustomerUrls
{
    public function __construct(public string|null $customer_portal) {}
}

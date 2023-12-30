<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Customer;

final readonly class CustomerUrls
{
    /**
     * @param string|null $customer_portal
     */
    public function __construct(public string|null $customer_portal) {}
}

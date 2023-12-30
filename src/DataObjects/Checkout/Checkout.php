<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;

final readonly class Checkout implements DataObjectContract
{
    use CanBeHydrated;

    public function __construct(
        public string $type,
        public string|int $id,
        public CheckoutAttributes $attributes
    ) {}

}

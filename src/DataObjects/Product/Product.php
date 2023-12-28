<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Product;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;

final readonly class Product implements DataObjectContract
{
    use CanBeHydrated;

    public function __construct(
        public string            $type,
        public string|int        $id,
        public ProductAttributes $attributes
    ) {}


}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Variant;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;

final readonly class Variant implements DataObjectContract
{
    use CanBeHydrated;

    /**
     * @param string $type
     * @param string|int $id
     * @param VariantAttributes $attributes
     */
    public function __construct(
        public string          $type,
        public string|int      $id,
        public VariantAttributes $attributes
    ) {}
}

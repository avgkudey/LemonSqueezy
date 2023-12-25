<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Store;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;

final readonly class Store implements DataObjectContract
{
    use CanBeHydrated;

    /**
     * @param string $type
     * @param string|int $id
     * @param StoreAttributes $attributes
     */
    public function __construct(
        public  string $type,
        public  string|int $id,
        public  StoreAttributes $attributes
    ) {}


}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Customer;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;

final readonly class Customer implements DataObjectContract
{
    use CanBeHydrated;

    /**
     * @param string $type
     * @param string|int $id
     * @param CustomerAttributes $attributes
     */
    public function __construct(
        public string             $type,
        public string|int         $id,
        public CustomerAttributes $attributes
    ) {}


}

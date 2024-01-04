<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources\Concerns;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use League\ObjectMapper\ObjectMapperUsingReflection;

trait CanBeHydrated
{
    /**
     * @param array<string,mixed> $data
     * @return DataObjectContract
     */
    public static function fromResponse(array $data): DataObjectContract
    {
        $mapper = new ObjectMapperUsingReflection();
        return $mapper->hydrateObject(className: self::class, payload: $data);
    }
}

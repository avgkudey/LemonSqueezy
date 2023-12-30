<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources\Concerns;

use League\ObjectMapper\ObjectMapperUsingReflection;

trait CanBeHydrated
{
    /**
     * @param array<string,mixed> $data
     * @return static
     */
    public static function fromResponse(array $data): static
    {
        $mapper = new ObjectMapperUsingReflection();
        return $mapper->hydrateObject(className: self::class, payload: $data);
    }
}

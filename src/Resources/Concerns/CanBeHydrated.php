<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources\Concerns;

use League\ObjectMapper\ObjectMapperUsingReflection;

trait CanBeHydrated
{
    /**
     * @param array<string,mixed> $data
     * @return self
     */
    public static function fromResponse(array $data): self
    {
        $mapper = new ObjectMapperUsingReflection();
        return $mapper->hydrateObject(className: self::class, payload: $data);
    }
}

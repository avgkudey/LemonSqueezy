<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Contracts;

interface DataObjectContract
{
    /**
     * @param array<string,mixed> $data
     * @return DataObjectContract
     */
    public static function fromResponse(array $data): DataObjectContract;
}

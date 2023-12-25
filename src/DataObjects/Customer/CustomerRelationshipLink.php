<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Customer;

final readonly class CustomerRelationshipLink
{
    /**
     * @param array{
     *     related:string|null,
     *     self:string|null,
     * } $links
     */
    public function __construct(
        public array $links
    ) {}
}

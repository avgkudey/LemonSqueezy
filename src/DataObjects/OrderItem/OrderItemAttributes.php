<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\OrderItem;

use DateTimeImmutable;

final readonly class OrderItemAttributes
{
    public function __construct(
        public string|int|null $id,
        public string|int $order_id,
        public string|int $product_id,
        public string|int $variant_id,
        public string $product_name,
        public string $variant_name,
        public int $price,
        public DateTimeImmutable $created_at,
        public DateTimeImmutable $updated_at,
        public bool $test_mode,
    ) {}
}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Discount;

use DateTimeImmutable;

final readonly class DiscountAttributes
{
    /**
     * @param int|null $store_id
     * @param string $name
     * @param string $code
     * @param int|float $amount
     * @param string $amount_type
     * @param bool $is_limited_to_products
     * @param bool $is_limited_redemptions
     * @param int|bool $max_redemptions
     * @param DateTimeImmutable|null $starts_at
     * @param DateTimeImmutable|null $expires_at
     * @param string|null $duration
     * @param int|null $duration_in_months
     * @param string $status
     * @param string $status_formatted
     * @param DateTimeImmutable $created_at
     * @param DateTimeImmutable $updated_at
     * @param bool $test_mode
     */
    public function __construct(
        public int|null $store_id,
        public string $name,
        public string $code,
        public int|float $amount,
        public string $amount_type,
        public bool $is_limited_to_products,
        public bool $is_limited_redemptions,
        public int|bool $max_redemptions,
        public DateTimeImmutable|null $starts_at,
        public DateTimeImmutable|null $expires_at,
        public string|null $duration,
        public int|null $duration_in_months,
        public string $status,
        public string $status_formatted,
        public DateTimeImmutable $created_at,
        public DateTimeImmutable $updated_at,
        public bool $test_mode,
    ) {}
}

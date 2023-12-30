<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Variant;

use DateTimeImmutable;

final readonly class VariantAttributes
{
    /**
     * @param string|int $product_id
     * @param string $name
     * @param string $slug
     * @param string|null $description
     * @param int $price
     * @param bool $is_subscription
     * @param string|null $interval
     * @param int|null $interval_count
     * @param bool $has_free_trial
     * @param string $trial_interval
     * @param int $trial_interval_count
     * @param bool $pay_what_you_want
     * @param int $min_price
     * @param int $suggested_price
     * @param bool $has_license_keys
     * @param int $license_activation_limit
     * @param bool $is_license_limit_unlimited
     * @param int $license_length_value
     * @param string $license_length_unit
     * @param bool $is_license_length_unlimited
     * @param int $sort
     * @param string $status
     * @param string $status_formatted
     * @param DateTimeImmutable $created_at
     * @param DateTimeImmutable $updated_at
     * @param bool $test_mode
     * @deprecated $is_subscription
     */
    public function __construct(
        public string|int $product_id,
        public string $name,
        public string $slug,
        public string|null $description,
        public int $price,
        public bool $is_subscription,
        public string|null $interval,
        public int|null $interval_count,
        public bool $has_free_trial,
        public string $trial_interval,
        public int $trial_interval_count,
        public bool $pay_what_you_want,
        public int $min_price,
        public int $suggested_price,
        public bool $has_license_keys,
        public int $license_activation_limit,
        public bool $is_license_limit_unlimited,
        public int $license_length_value,
        public string $license_length_unit,
        public bool $is_license_length_unlimited,
        public int $sort,
        public string $status,
        public string $status_formatted,
        public DateTimeImmutable $created_at,
        public DateTimeImmutable $updated_at,
        public bool $test_mode,
    ) {}
}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Store;

use DateTimeImmutable;

final readonly class StoreAttributes
{
    public function __construct(
        public string            $name,
        public string            $slug,
        public string            $domain,
        public string            $url,
        public string            $avatar_url,
        public string            $plan,
        public string            $country,
        public string            $country_nicename,
        public string            $currency,
        public int               $total_sales,
        public null|float|int    $total_revenue,
        public null|float|int    $thirty_day_sales,
        public null|float|int    $thirty_day_revenue,
        public DateTimeImmutable $created_at,
        public DateTimeImmutable $updated_at,
    ) {}
}

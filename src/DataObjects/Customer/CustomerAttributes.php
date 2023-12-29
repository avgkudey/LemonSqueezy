<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Customer;

use DateTimeImmutable;

final readonly class CustomerAttributes
{
    /**
     * @param string|int $store_id
     * @param string|null $name
     * @param string|null $email
     * @param string|null $status
     * @param string|null $city
     * @param string|null $region
     * @param string|null $country
     * @param int $total_revenue_currency
     * @param int $mrr
     * @param string|null $status_formatted
     * @param string|null $country_formatted
     * @param string|null $total_revenue_currency_formatted
     * @param string|null $mrr_formatted
     * @param CustomerUrls $urls
     * @param DateTimeImmutable $created_at
     * @param DateTimeImmutable $updated_at
     * @param bool $test_mode
     */
    public function __construct(
        public string|int        $store_id,
        public string|null       $name,
        public string|null       $email,
        public string|null       $status,
        public string|null       $city,
        public string|null       $region,
        public string|null       $country,
        public int               $total_revenue_currency,
        public int               $mrr,
        public string|null       $status_formatted,
        public string|null       $country_formatted,
        public string|null       $total_revenue_currency_formatted,
        public string|null       $mrr_formatted,
        public CustomerUrls             $urls,
        public DateTimeImmutable $created_at,
        public DateTimeImmutable $updated_at,
        public bool              $test_mode,
    ) {}
}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Product;

final readonly class ProductAttributes
{
    /**
     * @param int|string $store_id
     * @param string $name
     * @param string $slug
     * @param string|null $description
     * @param string $status
     * @param string $status_formatted
     * @param string|null $thumb_url
     * @param string|null $large_thumb_url
     * @param float $price
     * @param string $price_formatted
     * @param float|null $from_price
     * @param float|null $to_price
     * @param bool $pay_what_you_want
     * @param string $buy_now_url
     * @param string $created_at
     * @param string $updated_at
     * @param bool $test_mode
     */
    public function __construct(
        public int|string  $store_id,
        public string      $name,
        public string      $slug,
        public string|null $description,
        public string      $status,
        public string      $status_formatted,
        public string|null $thumb_url,
        public string|null $large_thumb_url,
        public float       $price,
        public string      $price_formatted,
        public null|float  $from_price,
        public null|float  $to_price,
        public bool        $pay_what_you_want,
        public string      $buy_now_url,
        public string      $created_at,
        public string      $updated_at,
        public bool        $test_mode,
    ) {}
}

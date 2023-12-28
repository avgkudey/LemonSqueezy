<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Product;

final readonly class ProductAttributes
{
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

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

use DateTimeImmutable;

final readonly class CheckoutAttributes
{
    public function __construct(
        public string|int|null $store_id,
        public string|int|null $variant_id,
        public int|null $custom_price,
        public ProductOptions|null $product_options,
        public CheckoutOptions|null $checkout_options,
        public CheckoutData|null $checkout_data,
        public CheckoutPreview|bool|null $preview,
        public DateTimeImmutable|null $expires_at,
        public DateTimeImmutable $created_at,
        public DateTimeImmutable $updated_at,
        public bool $test_mode,
        public string|null $url,
    ) {}
}

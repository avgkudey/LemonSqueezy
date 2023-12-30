<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

use DateTimeImmutable;

final readonly class CheckoutAttributes
{
    /**
     * @param string|int|null $store_id
     * @param string|int|null $variant_id
     * @param int|null $custom_price
     * @param ProductOptions|null $product_options
     * @param CheckoutOptions|null $checkout_options
     * @param CheckoutData|null $checkout_data
     * @param CheckoutPreview|bool|null $preview
     * @param DateTimeImmutable|null $expires_at
     * @param DateTimeImmutable $created_at
     * @param DateTimeImmutable $updated_at
     * @param bool $test_mode
     * @param string|null $url
     */
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

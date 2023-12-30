<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class CheckoutOptions
{
    public function __construct(
        public bool $embed,
        public bool $media,
        public bool $logo,
        public bool $desc,
        public bool $discount,
        public bool $dark,
        public bool $subscription_preview,
        public string|null $button_color,
    ) {}
}

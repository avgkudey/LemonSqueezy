<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class ProductOptions
{
    public function __construct(
        public string $name,
        public string $description,
        public array $media = [],
        public string $redirect_url,
        public string $receipt_button_text,
        public string $receipt_link_url,
        public string $receipt_thank_you_note,
        public array $enabled_variants = [],
    ) {}
}

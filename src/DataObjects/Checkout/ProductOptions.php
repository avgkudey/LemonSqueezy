<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Checkout;

final readonly class ProductOptions
{
    /**
     * @param string $name
     * @param string $description
     * @param array|null $media
     * @param string $redirect_url
     * @param string $receipt_button_text
     * @param string $receipt_link_url
     * @param string $receipt_thank_you_note
     * @param array|null $enabled_variants
     */
    public function __construct(
        public string $name,
        public string $description,
        public array|null $media,
        public string $redirect_url,
        public string $receipt_button_text,
        public string $receipt_link_url,
        public string $receipt_thank_you_note,
        public array|null $enabled_variants,
    ) {}
}

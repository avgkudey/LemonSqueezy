<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources\Concerns\Checkout;

trait HasProductOptions
{
    /**
     * @var array{
     *            name:string|null,
     *            description:string|null,
     *            media:array,
     *            redirect_url:string|null,
     *            receipt_button_text:string|null,
     *            receipt_link_url:string|null,
     *            receipt_thank_you_note:string|null,
     *           enabled_variants:array
     *       }
     */
    protected array $product_options = [];


    /**
     * @param string|null $name
     * @param string|null $description
     * @param array|null $media
     * @param string|null $redirect_url
     * @param string|null $receipt_button_text
     * @param string|null $receipt_link_url
     * @param string|null $receipt_thank_you_note
     * @param array|null $enabled_variants
     * @return static
     */
    public function product_options(
        string|null $name = null,
        string|null $description = null,
        array|null $media = null,
        string|null $redirect_url = null,
        string|null $receipt_button_text = null,
        string|null $receipt_link_url = null,
        string|null $receipt_thank_you_note = null,
        array|null $enabled_variants = null,
    ): static {


        $this->product_options = array_filter([
            'name' => $name,
            'description' => $description,
            'media' => $media,
            'redirect_url' => $redirect_url,
            'receipt_button_text' => $receipt_button_text,
            'receipt_link_url' => $receipt_link_url,
            'receipt_thank_you_note' => $receipt_thank_you_note,
            'enabled_variants' => $enabled_variants,
        ]);

        return $this;
    }
}

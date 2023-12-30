<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources\Concerns\Checkout;

trait HasCheckoutOptions
{
    /**
     * @var array{
     *           embed:bool,
     *           media:bool,
     *           logo:bool,
     *           desc:bool,
     *           discount:bool,
     *           dark:bool,
     *           subscription_preview:bool,
     *           button_color:string|null
     *       }
     */
    protected array $checkout_options = [];

    /**
     * @param bool|null $embed
     * @param bool|null $media
     * @param bool|null $logo
     * @param bool|null $desc
     * @param bool|null $discount
     * @param bool|null $dark
     * @param bool|null $subscription_preview
     * @param string|null $button_color
     * @return static
     */
    public function set_checkout_options(
        bool|null $embed,
        bool|null $media,
        bool|null $logo,
        bool|null $desc,
        bool|null $discount,
        bool|null $dark,
        bool|null $subscription_preview,
        string|null $button_color,
    ): static {

        $this->checkout_options = array_filter(array:[
            'embed' => $embed,
            'media' => $media,
            'logo' => $logo,
            'desc' => $desc,
            'discount' => $discount,
            'dark' => $dark,
            'subscription_preview' => $subscription_preview,
            'button_color' => $button_color,
        ], callback: fn($value) => null !== $value);

        return $this;
    }
}

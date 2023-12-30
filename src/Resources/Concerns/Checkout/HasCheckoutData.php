<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources\Concerns\Checkout;

trait HasCheckoutData
{
    /**
     * @var array{
     *           email:string,
     *           name:string|null,
     *           billing_address:array{
     *                country:string|null,
     *                zip:string|null,
     *            },
     *           tax_number:string|null,
     *           discount_code:string|null,
     *           custom:array{
     *                user_id:null|int|string
     *            },
     *            variant_quantities:array
     *       }
     */
    protected array $checkout_data = [];


    /**
     * @param string|null $email
     * @param string|null $name
     * @param array{
     *     country:string|null,
     *     zip:string|null
     * }|null $billing_address
     * @param string|null $tax_number
     * @param string|null $discount_code
     * @param string|null $custom
     * @param array|null $variant_quantities
     * @return static
     */
    public function set_checkout_data(
        string|null $email = null,
        string|null $name = null,
        array|null $billing_address = null,
        string|null $tax_number = null,
        string|null $discount_code = null,
        string|null $custom = null,
        array|null $variant_quantities = null,
    ): static {

        $this->checkout_data = array_filter(array:[
            'email' => $email,
            'name' => $name,
            'billing_address' => $billing_address,
            'tax_number' => $tax_number,
            'discount_code' => $discount_code,
            'custom' => $custom,
            'variant_quantities' => $variant_quantities,
        ], callback: fn($value) => ! ('' === $value || null === $value));

        return $this;

    }
}

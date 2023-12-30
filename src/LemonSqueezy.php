<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy;

use Avgkudey\LemonSqueezy\Resources\CheckoutResource;
use Avgkudey\LemonSqueezy\Resources\CustomerResource;
use Avgkudey\LemonSqueezy\Resources\OrderResource;
use Avgkudey\LemonSqueezy\Resources\ProductResource;
use Avgkudey\LemonSqueezy\Resources\StoreResource;
use Avgkudey\LemonSqueezy\Resources\VariantResource;

class LemonSqueezy
{
    public const VERSION = '1.0.0';

    /**
     * @return CheckoutResource
     */
    public static function checkouts(): CheckoutResource
    {
        return new CheckoutResource();
    }

    /**
     * @return CustomerResource
     */
    public static function customers(): CustomerResource
    {
        return new CustomerResource();
    }

    /**
     * @return OrderResource
     */
    public static function orders(): OrderResource
    {
        return new OrderResource();
    }

    /**
     * @return ProductResource
     */
    public static function products(): ProductResource
    {
        return new ProductResource();
    }

    /**
     * @return StoreResource
     */
    public static function stores(): StoreResource
    {
        return new StoreResource();
    }

    /**
     * @return VariantResource
     */
    public static function variants(): VariantResource
    {
        return new VariantResource();
    }

}

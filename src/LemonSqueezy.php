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

    public static function stores(): StoreResource
    {
        return new StoreResource();
    }

    public static function orders(): OrderResource
    {
        return new OrderResource();
    }

    public static function customers(): CustomerResource
    {
        return new CustomerResource();
    }

    public static function products(): ProductResource
    {
        return new ProductResource();
    }
    public static function variants(): VariantResource
    {
        return new VariantResource();
    }   public static function checkouts(): CheckoutResource
    {
        return new CheckoutResource();
    }

}

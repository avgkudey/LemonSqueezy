<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy;

use Avgkudey\LemonSqueezy\Resources\CustomerResource;
use Avgkudey\LemonSqueezy\Resources\OrderResource;
use Avgkudey\LemonSqueezy\Resources\ProductResource;
use Avgkudey\LemonSqueezy\Resources\StoreResource;

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

}

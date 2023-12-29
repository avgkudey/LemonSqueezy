<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Order;

use DateTimeImmutable;

final readonly class OrderAttributes
{
    public function __construct(
        public string|int $store_id,
        public string|int $customer_id,
        public string     $identifier,
        public int        $order_number,
        public string     $user_name,
        public string     $user_email,
        public string     $currency,
        public string     $currency_rate,
        public int        $subtotal,
        public int        $discount_total,
        public int        $tax,
        public int        $total,
        public int        $subtotal_usd,
        public int        $discount_total_usd,
        public int        $tax_usd,
        public int        $total_usd,
        public string|null     $tax_name,
        public string|null     $tax_rate,
        public string|null     $status,
        public string     $status_formatted,
        public bool     $refunded,
        public DateTimeImmutable|null     $refunded_at,
        public string     $subtotal_formatted,
        public string     $discount_total_formatted,
        public string     $tax_formatted,
        public string     $total_formatted,
    )
    {
    }
}


//"first_order_item": {
//    "id": 1,
//      "order_id": 1,
//      "product_id": 1,
//      "variant_id": 1,
//      "product_name": "Test Limited Licencse for 2 years",
//      "variant_name": "Default",
//      "price": 1199,
//      "created_at": "2021-08-17T09:45:53.000000Z",
//      "updated_at": "2021-08-17T09:45:53.000000Z",
//      "test_mode": false
//    },
//    "urls": {
//    "receipt": "https://app.lemonsqueezy.com/my-orders/104e18a2-d755-4d4b-80c4-a6c1dcbe1c10?signature=8847fff02e1bfb0c7c43ff1cdf1b1657a8eed2029413692663b86859208c9f42"
//    },
//    "created_at": "2021-08-17T09:45:53.000000Z",
//    "updated_at": "2021-08-17T09:45:53.000000Z",
//    "test_mode": false

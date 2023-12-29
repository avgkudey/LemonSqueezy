<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Order;

use Avgkudey\LemonSqueezy\DataObjects\OrderItem\OrderItemAttributes;
use DateTimeImmutable;
use League\ObjectMapper\PropertyCasters\CastToType;

final readonly class OrderAttributes
{
    /**
     * @param string|int $store_id
     * @param string|int $customer_id
     * @param string $identifier
     * @param int $order_number
     * @param string $user_name
     * @param string $user_email
     * @param string $currency
     * @param string $currency_rate
     * @param int $subtotal
     * @param int $discount_total
     * @param int $tax
     * @param int $total
     * @param int $subtotal_usd
     * @param int $discount_total_usd
     * @param int $tax_usd
     * @param int $total_usd
     * @param string|null $tax_name
     * @param string|null $tax_rate
     * @param string|null $status
     * @param string $status_formatted
     * @param bool $refunded
     * @param DateTimeImmutable|null $refunded_at
     * @param string $subtotal_formatted
     * @param string $discount_total_formatted
     * @param string $tax_formatted
     * @param string $total_formatted
     * @param OrderItemAttributes $first_order_item
     * @param object{
     *     receipt:string|null
     * } $urls
     * @param DateTimeImmutable $created_at
     * @param DateTimeImmutable $updated_at
     * @param bool $test_mode
     */
    public function __construct(
        public string|int             $store_id,
        public string|int             $customer_id,
        public string                 $identifier,
        public int                    $order_number,
        public string                 $user_name,
        public string                 $user_email,
        public string                 $currency,
        public string                 $currency_rate,
        public int                    $subtotal,
        public int                    $discount_total,
        public int                    $tax,
        public int                    $total,
        public int                    $subtotal_usd,
        public int                    $discount_total_usd,
        public int                    $tax_usd,
        public int                    $total_usd,
        public string|null            $tax_name,
        public string|null            $tax_rate,
        public string|null            $status,
        public string                 $status_formatted,
        public bool                   $refunded,
        public DateTimeImmutable|null $refunded_at,
        public string                 $subtotal_formatted,
        public string                 $discount_total_formatted,
        public string                 $tax_formatted,
        public string                 $total_formatted,
        public OrderItemAttributes    $first_order_item,
        #[CastToType('object')]
        public object                 $urls,
        public DateTimeImmutable      $created_at,
        public DateTimeImmutable      $updated_at,
        public bool                   $test_mode,
    ) {}
}



//    "urls": {
//    "receipt": "https://app.lemonsqueezy.com/my-orders/104e18a2-d755-4d4b-80c4-a6c1dcbe1c10?signature=8847fff02e1bfb0c7c43ff1cdf1b1657a8eed2029413692663b86859208c9f42"
//    },
//    "created_at": "2021-08-17T09:45:53.000000Z",
//    "updated_at": "2021-08-17T09:45:53.000000Z",
//    "test_mode": false

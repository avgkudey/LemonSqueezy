<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\DataObjects\Order\Order;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Throwable;

final class OrderResource extends BaseResource
{
    use CanBeHydrated;
    use CanUseHttp;


    public function all(): array
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: 'orders'
            );
            $data = $this->decodeResponse(response: $response);
        } catch (Throwable $exception) {
            throw $exception;
        }
        return array_map(callback: fn(array $store): DataObjectContract => $this->createDataObject($store), array: $data['data']);

    }
    public function find(int|string $id): Order
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: "orders/{$id}"
            );

            return $this->createDataObject($this->decodeResponse(response: $response)['data']);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    /**
     * @param array<string,array<string,mixed>> $data
     * @return Order
     */
    public function createDataObject(array $data): Order
    {
        return Order::fromResponse(data: $data);
    }

}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\DataObjects\Order\Order;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Exceptions\Order\FailedToFetchAllOrdersException;
use Avgkudey\LemonSqueezy\Exceptions\Order\FailedToFindOrderException;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Illuminate\Support\Collection;
use Throwable;

final class OrderResource extends BaseResource
{
    use CanBeHydrated;
    use CanUseHttp;

    protected string $end_point = 'orders';
    /**
     * @return Collection<int,Order>
     * @throws FailedToFetchAllOrdersException
     */
    public function all(): Collection
    {
        try {
            return collect(
                array_map(
                    callback: fn(array $order): DataObjectContract => $this->createDataObject($order),
                    array: $this->decodeResponse(response: $this->buildRequest(
                        METHOD: HTTP_METHOD::GET->value,
                        URI: $this->end_point
                    ))['data']
                )
            );

        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return collect();
            }

            throw new FailedToFetchAllOrdersException(
                message: 'Failed to fetch all orders',
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }

    /**
     * @param int|string $id
     * @return Order|null
     * @throws FailedToFindOrderException
     */
    public function find(int|string $id): Order|null
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: "{$this->end_point}/{$id}"
            );

            return $this->createDataObject($this->decodeResponse(response: $response)['data']);
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return null;
            }

            throw new FailedToFindOrderException(
                message: 'Failed to find order',
                code: $exception->getCode(),
                previous: $exception
            );
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

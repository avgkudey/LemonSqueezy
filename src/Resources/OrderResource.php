<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Order\Order;
use Avgkudey\LemonSqueezy\Exceptions\Order\FailedToFetchAllOrdersException;
use Avgkudey\LemonSqueezy\Exceptions\Order\FailedToFindOrderException;
use Exception;
use Throwable;

final class OrderResource extends BaseResource
{
    /**
     * @param array<string,array<string,mixed>> $data
     * @return Order
     */
    public function createDataObject(array $data): Order
    {
        return Order::fromResponse(data: $data);
    }

    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllOrdersException
    {
        return new FailedToFetchAllOrdersException(
            message: "Failed to fetch all orders",
            code: $exception->getCode(),
            previous: $exception
        );
    }


    public function failedToFindException(Throwable $exception): FailedToFindOrderException
    {
        return new FailedToFindOrderException(
            message: 'Failed to find order',
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param int|string $id
     * @return Order|null
     * @throws FailedToFindOrderException
     * @throws Exception
     */

    public function find(int|string $id): Order|null
    {
        return parent::find($id);
    }

    /**
     * @return string
     */
    protected function endPoint(): string
    {
        return 'orders';
    }
}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Store\Store;
use Avgkudey\LemonSqueezy\Exceptions\Store\FailedToFetchAllStoresException;
use Avgkudey\LemonSqueezy\Exceptions\Store\FailedToFindStoreException;
use Exception;
use Throwable;

final class StoreResource extends BaseResource
{
    /**
     * @param array<string,array<string,mixed>> $data
     * @return Store
     */
    public function createDataObject(array $data): Store
    {
        return Store::fromResponse(data: $data);
    }

    public function failedToFindException(Throwable $exception): FailedToFindStoreException
    {
        return new FailedToFindStoreException(
            message: 'Failed to find store',
            code: $exception->getCode(),
            previous: $exception
        );
    }

    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllStoresException
    {
        return new FailedToFetchAllStoresException(
            message: "Failed to fetch all stores",
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param int|string $id
     * @return Store|null
     * @throws FailedToFindStoreException
     * @throws Exception
     */

    public function find(int|string $id): Store|null
    {
        return parent::find($id);
    }

    protected function endPoint(): string
    {
        return 'stores';
    }

}

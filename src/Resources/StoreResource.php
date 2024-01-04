<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Store\Store;
use Avgkudey\LemonSqueezy\Exceptions\Store\FailedToFetchAllStoresException;
use Avgkudey\LemonSqueezy\Exceptions\Store\FailedToFindStoreException;
use Exception;
use Override;
use Throwable;

final class StoreResource extends BaseResource
{
    /**
     * @param array<int,array<int,mixed>> $data
     * @return Store
     */
    public function createDataObject(array $data): Store
    {
        return Store::fromResponse(data: $data);
    }

    /**
     * @param Throwable $exception
     * @return FailedToFetchAllStoresException
     */
    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllStoresException
    {
        return new FailedToFetchAllStoresException(
            message: "Failed to fetch all stores",
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param Throwable $exception
     * @return FailedToFindStoreException
     */
    public function failedToFindException(Throwable $exception): FailedToFindStoreException
    {
        return new FailedToFindStoreException(
            message: 'Failed to find store',
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

    #[Override]
    public function find(int|string $id): Store|null
    {
        return parent::find($id);
    }

    /**
     * @return string
     */
    protected function endPoint(): string
    {
        return 'stores';
    }

}

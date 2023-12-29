<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\DataObjects\Store\Store;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Exceptions\Store\FailedToFetchAllStoresException;
use Avgkudey\LemonSqueezy\Exceptions\Store\FailedToFindStoreException;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Illuminate\Support\Collection;
use Throwable;

final class StoreResource extends BaseResource
{
    use CanBeHydrated;
    use CanUseHttp;

    protected string $end_point = 'stores';

    /**
     * @return Collection<int,Store>
     * @throws FailedToFetchAllStoresException
     */
    public function all(): Collection
    {
        try {
            return collect(
                array_map(
                    callback: fn(array $store): DataObjectContract => $this->createDataObject($store),
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

            throw new FailedToFetchAllStoresException(
                message: "Failed to fetch all stores",
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }
    /**
     * @param string|int $id
     * @return Store|null
     * @throws FailedToFindStoreException
     */
    public function find(string|int $id): Store|null
    {
        try {
            return $this->createDataObject(
                $this->decodeResponse(response: $this->buildRequest(
                    METHOD: HTTP_METHOD::GET->value,
                    URI: "{$this->end_point}/{$id}"
                ))['data']
            );
        } catch (Throwable $exception) {

            if ( ! $this->throw_exceptions) {
                return null;
            }

            throw new FailedToFindStoreException(
                message: 'Failed to find store exception',
                code: $exception->getCode(),
                previous: $exception
            );
        }


    }


    /**
     * @param array<string,array<string,mixed>> $data
     * @return Store
     */
    public function createDataObject(array $data): Store
    {
        return Store::fromResponse(data: $data);
    }
}

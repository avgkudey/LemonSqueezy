<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\DataObjects\Product\Product;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Exceptions\Product\FailedToFetchAllProductsException;
use Avgkudey\LemonSqueezy\Exceptions\Product\FailedToFindProductException;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Illuminate\Support\Collection;
use Throwable;

final class ProductResource extends BaseResource
{
    use CanBeHydrated;
    use CanUseHttp;

    protected string $end_point = 'products';

    /**
     * @return Collection<int,Product>
     * @throws FailedToFetchAllProductsException
     */
    public function all(): Collection
    {
        try {

            return collect(
                array_map(
                    callback: fn(array $product): DataObjectContract => $this->createDataObject($product),
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
            throw new FailedToFetchAllProductsException(
                message: 'Failed to fetch all products',
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }

    /**
     * @param string|int $id
     * @return Product|null
     * @throws FailedToFindProductException
     */
    public function find(string|int $id): Product|null
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

            throw new FailedToFindProductException(
                message: 'Failed to find customer exception',
                code: $exception->getCode(),
                previous: $exception
            );
        }


    }

    /**
     * @param array<string,array<string,mixed>> $data
     * @return Product
     */
    public function createDataObject(array $data): Product
    {
        return Product::fromResponse(data: $data);
    }


    /**
     * @return Collection<int,Product>
     * @throws FailedToFetchAllProductsException
     */
    public function get(): Collection
    {
        try {
            return collect(
                array_map(
                    callback: fn(array $product): DataObjectContract => $this->createDataObject($product),
                    array: $this->decodeResponse(response: $this->buildRequest(
                        METHOD: HTTP_METHOD::GET->value,
                        URI: $this->end_point . $this->formatFilters()
                    ))['data']
                )
            );
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return collect();
            }

            throw new FailedToFetchAllProductsException(
                message: "Failed to fetch all products",
                code: $exception->getCode(),
                previous: $exception
            );
        }
    }
}

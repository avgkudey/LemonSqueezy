<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Product\Product;
use Avgkudey\LemonSqueezy\Exceptions\Product\FailedToFetchAllProductsException;
use Avgkudey\LemonSqueezy\Exceptions\Product\FailedToFindProductException;
use Exception;
use Throwable;

final class ProductResource extends BaseResource
{
    /**
     * @param array<string,array<string,mixed>> $data
     * @return Product
     */
    public function createDataObject(array $data): Product
    {
        return Product::fromResponse(data: $data);
    }

    public function failedToFindException(Throwable $exception): FailedToFindProductException
    {
        return new FailedToFindProductException(
            message: 'Failed to find product',
            code: $exception->getCode(),
            previous: $exception
        );
    }

    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllProductsException
    {
        return new FailedToFetchAllProductsException(
            message: "Failed to fetch all products",
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param int|string $id
     * @return Product|null
     * @throws FailedToFindProductException
     * @throws Exception
     */

    public function find(int|string $id): Product|null
    {
        return parent::find($id);
    }

    protected function endPoint(): string
    {
        return 'products';
    }
}

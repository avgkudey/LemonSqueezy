<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Product\Product;
use Avgkudey\LemonSqueezy\DataObjects\Variant\Variant;
use Avgkudey\LemonSqueezy\Exceptions\Product\FailedToFetchAllProductsException;
use Avgkudey\LemonSqueezy\Exceptions\Product\FailedToFindProductException;
use Exception;
use Throwable;

final class VariantResource extends BaseResource
{
    /**
     * @param array<string,array<string,mixed>> $data
     * @return Variant
     */
    public function createDataObject(array $data): Variant
    {
        return Variant::fromResponse(data: $data);
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
     * @return Variant|null
     * @throws FailedToFindProductException
     * @throws Exception
     */

    public function find(int|string $id): Variant|null
    {
        return parent::find($id);
    }

    protected function endPoint(): string
    {
        return 'variants';
    }
}

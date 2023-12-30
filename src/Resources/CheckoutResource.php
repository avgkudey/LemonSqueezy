<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Checkout\Checkout;
use Avgkudey\LemonSqueezy\DataObjects\Variant\Variant;
use Avgkudey\LemonSqueezy\Exceptions\Product\FailedToFindProductException;
use Avgkudey\LemonSqueezy\Exceptions\Variant\FailedToFetchAllVariantsException;
use Avgkudey\LemonSqueezy\Exceptions\Variant\FailedToFindVariantException;
use Exception;
use Throwable;

final class CheckoutResource extends BaseResource
{
    /**
     * @param array<string,array<string,mixed>> $data
     * @return Checkout
     */
    public function createDataObject(array $data): Checkout
    {
        return Checkout::fromResponse(data: $data);
    }

    public function failedToFindException(Throwable $exception): FailedToFindVariantException
    {
        return new FailedToFindVariantException(
            message: 'Failed to find checkout',
            code: $exception->getCode(),
            previous: $exception
        );
    }

    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllVariantsException
    {
        dd($exception->getMessage());
        return new FailedToFetchAllVariantsException(
            message: "Failed to fetch all checkouts",
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

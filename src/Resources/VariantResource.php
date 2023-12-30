<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Variant\Variant;
use Avgkudey\LemonSqueezy\Exceptions\Variant\FailedToFetchAllVariantsException;
use Avgkudey\LemonSqueezy\Exceptions\Variant\FailedToFindVariantException;
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

    /**
     * @param Throwable $exception
     * @return FailedToFetchAllVariantsException
     */
    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllVariantsException
    {
        return new FailedToFetchAllVariantsException(
            message: "Failed to fetch all variants",
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param Throwable $exception
     * @return FailedToFindVariantException
     */
    public function failedToFindException(Throwable $exception): FailedToFindVariantException
    {
        return new FailedToFindVariantException(
            message: 'Failed to find variant',
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param int|string $id
     * @return Variant|null
     * @throws FailedToFindVariantException
     * @throws Exception
     */

    public function find(int|string $id): Variant|null
    {
        return parent::find($id);
    }

    /**
     * @return string
     */
    protected function endPoint(): string
    {
        return 'variants';
    }
}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Discount\Discount;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Exceptions\Discount\FailedToCreateDiscountException;
use Avgkudey\LemonSqueezy\Exceptions\Discount\FailedToDeleteDiscountException;
use Avgkudey\LemonSqueezy\Exceptions\Discount\FailedToFetchAllDiscountsException;
use Avgkudey\LemonSqueezy\Exceptions\Discount\FailedToFindDiscountException;
use Avgkudey\LemonSqueezy\Exceptions\Order\FailedToFindOrderException;
use Avgkudey\LemonSqueezy\Resources\Concerns\Discount\CanUseDiscountHelpers;
use Exception;
use Illuminate\Support\Arr;
use Throwable;

final class DiscountResource extends BaseResource
{
    use CanUseDiscountHelpers;


    /**
     * @param array{
     *     name:string,
     *     code:string,
     *     amount:int,
     *     amount_type:string|null,
     *     is_limited_to_products:bool
     * } $attributes
     * @param array<int,array{
     *     type:string,
     *     id:string
     * }> $variants
     * @return Discount|null
     * @throws FailedToCreateDiscountException
     */
    public function create(array $attributes, array $variants = []): Discount|null
    {

        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::POST->value,
                URI: $this->endPoint(),
                PAYLOAD: [
                    'data' => [
                        'type' => 'discounts',
                        'attributes' => array_filter(
                            Arr::only(array: $attributes, keys: [
                                'name',
                                'code',
                                'amount',
                                'amount_type',
                                'is_limited_to_products',
                            ])
                        ),
                        'relationships' => [
                            'store' => [
                                'data' => [
                                    'type' => 'stores',
                                    'id' => config('lemon-squeezy.storeId'),
                                ],
                            ],
                            'variants' => [
                                'data' => array_filter(
                                    $variants
                                )
                            ]
                        ],
                    ],
                ]
            );
            $decoded = $this->decodeResponse(response: $response);
            if (isset($decoded['errors'])) {
                if ( ! $this->throw_exceptions) {
                    return null;
                }

                throw new FailedToCreateDiscountException(
                    message: $decoded['errors'][0]['detail'],
                    code: (int)$decoded['errors'][0]['status']
                );

            }

            return $this->createDataObject($decoded['data']);
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return null;
            }
            dd($exception->getMessage());
            if ($exception instanceof FailedToCreateDiscountException) {
                throw $exception;
            }

            throw new FailedToCreateDiscountException(
                message: 'Failed to create discount',
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }
    /**
     * @param array<int,array<int,mixed>> $data
     * @return Discount
     */
    public function createDataObject(array $data): Discount
    {
        return Discount::fromResponse(data: $data);
    }

    /**
     * @param string|int $id
     * @return bool
     * @throws FailedToDeleteDiscountException
     */
    public function delete(string|int $id): bool
    {
        try {
            $status = $this->buildRequest(
                METHOD: HTTP_METHOD::DELETE->value,
                URI: "{$this->endPoint()}/{$id}",
            )->status();

            if(404 === $status) {
                if ( ! $this->throw_exceptions) {
                    return false;
                }
                throw new FailedToFindDiscountException(
                    message: 'Failed to find discount',
                    code: 404,
                );
            }

            return 204 === $status;

        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return false;
            }
            if ($exception instanceof FailedToDeleteDiscountException) {
                throw $exception;
            }

            throw new FailedToDeleteDiscountException(
                message: 'Failed to delete discount',
                code: $exception->getCode(),
                previous: $exception
            );

        }
    }

    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllDiscountsException
    {
        return new FailedToFetchAllDiscountsException(
            message: "Failed to fetch all discounts",
            code: $exception->getCode(),
            previous: $exception
        );
    }


    public function failedToFindException(Throwable $exception): FailedToFindDiscountException
    {
        return new FailedToFindDiscountException(
            message: 'Failed to find discount',
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param int|string $id
     * @return Discount|null
     * @throws FailedToFindOrderException
     * @throws Exception
     */

    public function find(int|string $id): Discount|null
    {
        return parent::find($id);
    }

    /**
     * @return string
     */
    protected function endPoint(): string
    {
        return 'discounts';
    }

}

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Checkout\Checkout;
use Avgkudey\LemonSqueezy\DataObjects\Variant\Variant;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Exceptions\Checkout\FailedToCreateCheckoutException;
use Avgkudey\LemonSqueezy\Exceptions\Checkout\FailedToFetchAllCheckoutsException;
use Avgkudey\LemonSqueezy\Exceptions\Checkout\FailedToFindCheckoutException;
use Avgkudey\LemonSqueezy\Resources\Concerns\Checkout\CanUseCheckoutHelpers;
use Exception;
use Throwable;

final class CheckoutResource extends BaseResource
{
    use CanUseCheckoutHelpers;


    /**
     * @param int|string $variant
     * @return Checkout|null
     * @throws FailedToCreateCheckoutException
     */
    public function create(int|string $variant): Checkout|null
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::POST->value,
                URI: $this->endPoint(),
                PAYLOAD: [
                    'data' => [
                        'type' => 'checkouts',
                        'attributes' => [
                            'custom_price' => '',
                            'checkout_data' => array_filter(array:$this->checkout_data, callback: fn($value) => ! ('' === $value || null === $value)),
                            'checkout_options' => array_filter(array:$this->checkout_options, callback: fn($value) => null !== $value) ,
                            'expires_at' => null

                        ],
                        'relationships' => [
                            'store' => [
                                'data' => [
                                    'type' => 'stores',
                                    'id' => config('lemon-squeezy.storeId')
                                ]
                            ],
                            'variant' => [
                                'data' => [
                                    'type' => 'variants',
                                    'id' => (string)$variant
                                ]
                            ]
                        ]
                    ]
                ]
            );
            $decoded = $this->decodeResponse(response: $response);
            if (isset($decoded['errors'])) {
                if ( ! $this->throw_exceptions) {
                    return null;
                }

                throw new FailedToCreateCheckoutException(
                    message: $decoded['errors'][0]['detail'],
                    code: (int)$decoded['errors'][0]['status']
                );

            }

            return $this->createDataObject($decoded['data']);
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return null;
            }

            if ($exception instanceof FailedToCreateCheckoutException) {
                throw $exception;
            }

            throw new FailedToCreateCheckoutException(
                message: 'Failed to create checkout',
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }


    /**
     * @param array<string,array<string,mixed>> $data
     * @return Checkout
     */
    public function createDataObject(array $data): Checkout
    {
        return Checkout::fromResponse(data: $data);
    }

    /**
     * @param Throwable $exception
     * @return FailedToFetchAllCheckoutsException
     */
    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllCheckoutsException
    {
        return new FailedToFetchAllCheckoutsException(
            message: "Failed to fetch all checkouts",
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param Throwable $exception
     * @return FailedToFindCheckoutException
     */
    public function failedToFindException(Throwable $exception): FailedToFindCheckoutException
    {
        return new FailedToFindCheckoutException(
            message: 'Failed to find checkout',
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param int|string $id
     * @return Variant|null
     * @throws FailedToFindCheckoutException
     * @throws Exception
     */

    public function find(int|string $id): Variant|null
    {
        return parent::find($id);
    }







    protected function endPoint(): string
    {
        return 'checkouts';
    }
}

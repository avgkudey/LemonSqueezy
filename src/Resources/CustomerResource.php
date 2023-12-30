<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\DataObjects\Customer\Customer;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToCreateCustomerException;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToFetchAllCustomersException;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToFindCustomerException;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToUpdateCustomerException;
use Exception;
use Illuminate\Support\Arr;
use Throwable;

final class CustomerResource extends BaseResource
{
    /**
     * @param array{
     *     name:string,
     *     email:string,
     *     city:string|null,
     *     region:string|null,
     *     country:string|null
     * } $attributes
     * @return Customer|null
     * @throws FailedToCreateCustomerException
     */
    public function create(array $attributes): Customer|null
    {

        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::POST->value,
                URI: $this->endPoint(),
                PAYLOAD: [
                    'data' => [
                        'type' => 'customers',
                        'attributes' => Arr::only(array: $attributes, keys: [
                            'name',
                            'email',
                            'city',
                            'region',
                            'country',
                        ]),
                        'relationships' => [
                            'store' => [
                                'data' => [
                                    'type' => 'stores',
                                    'id' => config('lemon-squeezy.storeId'),
                                ],
                            ],
                        ],
                    ],
                ]
            );
            $decoded = $this->decodeResponse(response: $response);
            if (isset($decoded['errors'])) {
                if ( ! $this->throw_exceptions) {
                    return null;
                }

                throw new FailedToCreateCustomerException(
                    message: $decoded['errors'][0]['detail'],
                    code: (int)$decoded['errors'][0]['status']
                );

            }

            return $this->createDataObject($decoded['data']);
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return null;
            }

            if ($exception instanceof FailedToCreateCustomerException) {
                throw $exception;
            }

            throw new FailedToCreateCustomerException(
                message: 'Failed to create customer',
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }

    /**
     * @param array<int,array<int,mixed>> $data
     * @return Customer
     */
    public function createDataObject(array $data): Customer
    {
        return Customer::fromResponse(data: $data);
    }

    /**
     * @param Throwable $exception
     * @return FailedToFetchAllCustomersException
     */
    public function failedToFetchAllException(Throwable $exception): FailedToFetchAllCustomersException
    {
        return new FailedToFetchAllCustomersException(
            message: "Failed to fetch all customers",
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param Throwable $exception
     * @return FailedToFindCustomerException
     */
    public function failedToFindException(Throwable $exception): FailedToFindCustomerException
    {
        return new FailedToFindCustomerException(
            message: 'Failed to find customer',
            code: $exception->getCode(),
            previous: $exception
        );
    }

    /**
     * @param int|string $id
     * @return Customer|null
     * @throws FailedToFindCustomerException
     * @throws Exception
     */

    public function find(int|string $id): Customer|null
    {
        return parent::find($id);
    }

    /**
     * @param int|string $id
     * @param array{
     *     name:string,
     *     email:string,
     *     city:string|null,
     *     region:string|null,
     *     country:string|null
     * } $attributes
     * @return Customer|null
     * @throws FailedToUpdateCustomerException
     */
    public function update(int|string $id, array $attributes): Customer|null
    {

        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::PATCH->value,
                URI: "{$this->endPoint()}/{$id}",
                PAYLOAD: [
                    'data' => [
                        'type' => 'customers',
                        'id' => (string)$id,
                        'attributes' => Arr::only(array: $attributes, keys: [
                            'name',
                            'email',
                            'city',
                            'region',
                            'country',
                        ]),
                    ],
                ]
            );
            $decoded = $this->decodeResponse(response: $response);
            if (isset($decoded['errors'])) {
                if ( ! $this->throw_exceptions) {
                    return null;
                }

                throw new FailedToUpdateCustomerException(
                    message: $decoded['errors'][0]['detail'],
                    code: (int)$decoded['errors'][0]['status']
                );

            }

            return $this->createDataObject($decoded['data']);
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return null;
            }

            if ($exception instanceof FailedToUpdateCustomerException) {
                throw $exception;
            }

            throw new FailedToUpdateCustomerException(
                message: 'Failed to update customer',
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }

    /**
     * @return string
     */
    protected function endPoint(): string
    {
        return 'customers';
    }
}

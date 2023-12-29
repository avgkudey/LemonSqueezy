<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\DataObjects\Customer\Customer;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToCreateCustomerException;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToFetchAllCustomersException;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToFindCustomerException;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Throwable;

final class CustomerResource extends BaseResource
{
    use CanBeHydrated;
    use CanUseHttp;



    /**
     * @return Collection<int,Customer>
     * @throws FailedToFetchAllCustomersException
     */
    public function all(): Collection
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: 'customers'
            );
            $data = $this->decodeResponse(response: $response);
            return collect(array_map(callback: fn(array $customer): DataObjectContract => $this->createDataObject($customer), array: $data['data']));
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return collect();
            }

            throw new FailedToFetchAllCustomersException(
                message: "Failed to fetch all customers",
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }


    /**
     * @param string|int $id
     * @return Customer|null
     * @throws FailedToFindCustomerException
     */
    public function find(string|int $id): Customer|null
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: "customers/{$id}"
            );
            return $this->createDataObject($this->decodeResponse(response: $response)['data']);
        } catch (Throwable $exception) {

            if ( ! $this->throw_exceptions) {
                return null;
            }

            throw new FailedToFindCustomerException(
                message: 'Failed to find customer exception',
                code: $exception->getCode(),
                previous: $exception
            );
        }


    }

    /**
     * @param array<string,array<string,mixed>> $data
     * @return Customer
     */
    public function createDataObject(array $data): Customer
    {
        return Customer::fromResponse(data: $data);
    }

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
            $response = $this->buildRequest(METHOD: HTTP_METHOD::POST->value, URI: 'customers', PAYLOAD: [

                'data' => [
                    'type' => 'customers',
                    'attributes' => Arr::only(array:$attributes, keys: [
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
            ]);
            $decoded = $this->decodeResponse(response: $response);
            if(isset($decoded['errors'])) {
                if ( ! $this->throw_exceptions) {
                    return null;
                }

                throw new FailedToCreateCustomerException(message: $decoded['errors'][0]['detail'], code:(int) $decoded['errors'][0]['status']);

            }

            return $this->createDataObject($this->decodeResponse(response: $response)['data']);
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return null;
            }

            if($exception instanceof FailedToCreateCustomerException) {
                throw $exception;
            }

            throw new FailedToCreateCustomerException(message: 'Failed to create customer', code: $exception->getCode(), previous: $exception);
        }

    }

}

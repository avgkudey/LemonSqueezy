<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\DataObjects\Customer\Customer;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToFetchAllCustomersException;
use Avgkudey\LemonSqueezy\Exceptions\Customer\FailedToFindAllCustomerException;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Throwable;

final class CustomerResource
{
    use CanBeHydrated;
    use CanUseHttp;


    /**
     * @throws FailedToFetchAllCustomersException
     */
    public function all(): array
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: 'customers'
            );
            $data = $this->decodeResponse(response: $response);
            return array_map(callback: fn(array $customer): DataObjectContract => $this->createDataObject($customer), array: $data['data']);
        } catch (Throwable $exception) {
            throw new FailedToFetchAllCustomersException(
                message: "Failed to fetch all customers",
                code: $exception->getCode(),
                previous: $exception
            );
        }

    }

    /**
     * @throws FailedToFindAllCustomerException
     */
    public function find(string|int $id): Customer
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: "customers/{$id}"
            );
            return $this->createDataObject($this->decodeResponse(response: $response)['data']);
        } catch (Throwable $exception) {
            throw new FailedToFindAllCustomerException(
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

    public function create(): void
    {
        //       TODO
    }

}

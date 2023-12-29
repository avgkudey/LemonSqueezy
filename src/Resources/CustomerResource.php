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
use Illuminate\Support\Collection;
use Throwable;

final class CustomerResource
{
    use CanBeHydrated;
    use CanUseHttp;

    private bool $throw_exceptions = true;


    public function withoutExceptionThrowing(): CustomerResource
    {
        $this->throw_exceptions = false;
        return $this;
    }


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
     * @throws FailedToFindAllCustomerException
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

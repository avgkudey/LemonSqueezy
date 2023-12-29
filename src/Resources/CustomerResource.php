<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\DataObjects\Customer\Customer;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Throwable;

final class CustomerResource
{
    use CanBeHydrated;
    use CanUseHttp;


    public function all(): array
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: 'customers'
            );
            $data = $this->decodeResponse(response: $response);
        } catch (Throwable $exception) {
            throw $exception;
        }
        return array_map(callback: fn(array $store): DataObjectContract => $this->createDataObject($store), array: $data['data']);

    }
    public function find(string|int $id): Customer
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET->value,
                URI: "customers/{$id}"
            );
            return $this->createDataObject($this->decodeResponse(response: $response)['data']);
        } catch (Throwable $exception) {
            throw $exception;
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

<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\DataObjects\Store\Store;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Throwable;

final class StoreResource
{
    use CanBeHydrated;
    use CanUseHttp;


    /**
     * @param array<string,array<string,mixed>> $data
     * @return DataObjectContract
     */
    public function createDataObject(array $data): DataObjectContract
    {
        return Store::fromResponse(data:$data);
    }

    public function all()
    {
        try {
            $response = $this->buildRequest(
                METHOD: HTTP_METHOD::GET,
                URI: '/stores'
            );
            $data = $this->decodeResponse(response: $response);
        } catch (Throwable $exception) {
            throw $exception;
        }
        return array_map(callback: fn(array $store): DataObjectContract => $this->createDataObject($store), array: $data['data']);

    }
}

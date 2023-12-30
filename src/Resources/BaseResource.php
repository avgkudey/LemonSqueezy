<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Avgkudey\LemonSqueezy\Contracts\DataObjectContract;
use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanBeHydrated;
use Avgkudey\LemonSqueezy\Resources\Concerns\CanUseHttp;
use Exception;
use Illuminate\Support\Collection;
use Throwable;

abstract class BaseResource
{
    use CanBeHydrated;
    use CanUseHttp;
    protected Collection $filters;

    protected bool $throw_exceptions = true;

    public function __construct()
    {
        $this->filters = collect();
    }

    /**
     * @param array<int, array<int,mixed>> $data
     * @return DataObjectContract
     */
    abstract protected function createDataObject(array $data): DataObjectContract;

    /**
     * @return string
     */
    abstract protected function endPoint(): string;

    /**
     * @param Throwable $exception
     * @return Exception
     */
    abstract protected function failedToFetchAllException(Throwable $exception): Exception;

    /**
     * @param Throwable $exception
     * @return Exception
     */
    abstract protected function failedToFindException(Throwable $exception): Exception;

    /**
     * @return Collection<int,DataObjectContract>
     * @throws Exception
     */
    public function all(): Collection
    {
        try {
            return collect(
                array_map(
                    callback: fn(array $customer): DataObjectContract => $this->createDataObject($customer),
                    array: $this->decodeResponse(response: $this->buildRequest(
                        METHOD: HTTP_METHOD::GET->value,
                        URI: $this->endPoint()
                    ))['data']
                )
            );
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return collect();
            }

            throw $this->failedToFetchAllException($exception);
        }

    }

    /**
     * @param string|int $id
     * @return DataObjectContract|null
     * @throws Exception
     */
    public function find(string|int $id): DataObjectContract|null
    {
        try {
            return $this->createDataObject(
                $this->decodeResponse(
                    response: $this->buildRequest(
                        METHOD: HTTP_METHOD::GET->value,
                        URI: "{$this->endPoint()}/{$id}"
                    )
                )['data']
            );
        } catch (Throwable $exception) {

            if ( ! $this->throw_exceptions) {
                return null;
            }

            throw $this->failedToFindException($exception);
        }
    }

    /**
     * @return string
     */
    public function formatFilters(): string
    {
        if (0 === $this->filters->count()) {
            return '';
        }

        $formatted = '?';

        $this->filters->each(callback: function (object $filter, $key) use (&$formatted): void {
            $formatted .= ($key > 0 ? '&' : '') . "filter[{$filter->field}]={$filter->value}";
        });

        return $formatted;
    }

    /**
     * @return Collection<int,DataObjectContract>
     * @throws Exception
     */
    public function get(): Collection
    {
        try {
            return collect(
                value: array_map(
                    callback: fn(array $item): DataObjectContract => $this->createDataObject($item),
                    array: $this->decodeResponse(response: $this->buildRequest(
                        METHOD: HTTP_METHOD::GET->value,
                        URI: $this->endPoint() . $this->formatFilters()
                    ))['data']
                )
            );
        } catch (Throwable $exception) {
            if ( ! $this->throw_exceptions) {
                return collect();
            }

            throw $this->failedToFetchAllException($exception);
        }
    }

    /**
     * @param string $field
     * @param mixed $value
     * @return $this
     */
    public function where(string $field, mixed $value): self
    {

        $this->filters->push(
            (object)[
                'field' => $field,
                'value' => $value
            ]
        );
        return $this;
    }

    /**
     * @return $this
     */
    public function withoutExceptionThrowing(): self
    {
        $this->throw_exceptions = false;
        return $this;
    }

}

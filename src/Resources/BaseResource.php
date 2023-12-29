<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

use Illuminate\Support\Collection;

abstract class BaseResource
{
    protected bool $throw_exceptions = true;
    protected Collection $filters ;

    public function __construct()
    {
        $this->filters = collect();
    }

    /**
     * @return Collection<int,mixed>
     */
    abstract public function get(): Collection;

    public function withoutExceptionThrowing(): self
    {
        $this->throw_exceptions = false;
        return $this;
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
     * @return string
     */
    public function formatFilters(): string
    {
        if(0 === $this->filters->count()) {
            return '';
        }

        $formatted = '?';

        $this->filters->each(callback: function (object $filter, $key) use (&$formatted): void {
            $formatted .= ($key > 0 ? '&' : '') . "filter[{$filter->field}]={$filter->value}";
        });

        return $formatted;
    }

}

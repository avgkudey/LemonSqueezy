<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources;

abstract class BaseResource
{
    protected bool $throw_exceptions = true;


    public function withoutExceptionThrowing(): self
    {
        $this->throw_exceptions = false;
        return $this;
    }

}

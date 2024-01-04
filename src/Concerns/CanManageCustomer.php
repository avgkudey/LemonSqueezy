<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Concerns;

use Avgkudey\LemonSqueezy\LemonSqueezy;

trait CanManageCustomer
{
    public function asLemonSqueezyCustomer()
    {
        $customer = null;
        if ($this->lemonSqueezyId()) {
            $customer = LemonSqueezy::customers()->find($this->lemonSqueezyId());
        } else {
            $customer = LemonSqueezy::customers()->where('email', $this->email)->get()->first();
            if ($customer) {
                $this->lesmon_squeezy_id = $customer->id;
                $this->save();
            }
        }

        if(null === $customer) {
            $customer = $this->createAsLemonSqueezyCustomer();
        }

        return $customer;


    }

    public function createAsLemonSqueezyCustomer(array $attributes = [])
    {
        if ( ! array_key_exists('name', $attributes) && $name = $this->name) {
            $attributes['name'] = $name;
        }

        if ( ! array_key_exists('email', $attributes) && $email = $this->email) {
            $attributes['email'] = $email;
        }



        $customer = LemonSqueezy::customers()->create($attributes);

        $this->lemon_squeezy_id = $customer->id;
        $this->save();

        return $customer;

    }
    /**
     * @return bool
     */
    public function hasLemonSqueezyId(): bool
    {
        return null !== $this->lemon_squeezy_id;

    }
    /**
     * @return string|null
     */
    public function lemonSqueezyId(): ?string
    {
        return $this->lemon_squeezy_id;

    }
}

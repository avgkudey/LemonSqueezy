<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Concerns;

use Avgkudey\LemonSqueezy\LemonSqueezy;

trait CanManageCustomer
{
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

    public function createAsLemonSqueezyCustomer(array $attributes=[])
    {
        if (! array_key_exists('name', $attributes) && $name = $this->name) {
            $attributes['name'] = $name;
        }

        if (! array_key_exists('email', $attributes) && $email = $this->email) {
            $attributes['email'] = $email;
        }



        $customer= LemonSqueezy::customers()->create($attributes);

        $this->lemon_squeezy_id=$customer->id;
        $this->save();

        return $customer;

    }
}

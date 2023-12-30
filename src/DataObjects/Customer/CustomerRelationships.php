<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\DataObjects\Customer;

use League\ObjectMapper\MapFrom;

final readonly class CustomerRelationships
{
    /**
     * @param CustomerRelationshipLink $store
     * @param CustomerRelationshipLink $orders
     * @param CustomerRelationshipLink $subscriptions
     * @param CustomerRelationshipLink $license_keys
     */
    public function __construct(
        public CustomerRelationshipLink $store,
        public CustomerRelationshipLink $orders,
        public CustomerRelationshipLink $subscriptions,
        #[MapFrom('license-keys')]
        public CustomerRelationshipLink $license_keys,
    ) {}
}

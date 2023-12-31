<?php

declare(strict_types=1);

return [
    'apiKey' => env('LEMON_SQUEEZY_API_KEY'),
    'storeId' => env('LEMON_SQUEEZY_STORE_ID'),
    'baseUrl' => env('LEMON_SQUEEZY_BASE_URL', 'https://api.lemonsqueezy.com/v1')
];

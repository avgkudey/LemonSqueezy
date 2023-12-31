<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Enums;

enum HTTP_METHOD: string
{
    case DELETE = 'delete';
    case GET = 'get';
    case PATCH = 'patch';
    case POST = 'post';

}

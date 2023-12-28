<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources\Concerns;

use Avgkudey\LemonSqueezy\LemonSqueezy;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

trait CanUseHttp
{
    /**
     * @param string $METHOD
     * @param string $URI
     * @param array $PAYLOAD
     * @return PromiseInterface|Response
     */
    public function buildRequest(string $METHOD, string $URI, array $PAYLOAD = []): PromiseInterface|Response
    {

        return Http::withToken(config('lemon-squeezy.apiKey'))
            ->withUserAgent('Avgkudey-LemonSqueezy;' . LemonSqueezy::VERSION)
            ->accept('application/vnd.api+json')
            ->contentType('application/vnd.api+json')
            ->{$METHOD}(config('lemon-squeezy.baseUrl') . "/{$URI}", $PAYLOAD);


    }

    /**
     * @param Response $response
     * @return array
     */
    public function decodeResponse(Response $response): array
    {
        return $response->json();
    }
}

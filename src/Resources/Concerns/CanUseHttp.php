<?php

declare(strict_types=1);

namespace Avgkudey\LemonSqueezy\Resources\Concerns;

use Avgkudey\LemonSqueezy\Enums\HTTP_METHOD;
use Avgkudey\LemonSqueezy\LemonSqueezy;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use JsonException;

trait CanUseHttp
{
    /**
     * @param HTTP_METHOD $METHOD
     * @param string $URI
     * @param array $PAYLOAD
     * @return PromiseInterface|Response
     */
    public function buildRequest(HTTP_METHOD $METHOD, string $URI, array $PAYLOAD = [])
    {

        return  Http::withToken(config('lemon_squeezy.apiKey'))
            ->withUserAgent('Avgkudey-LemonSqueezy;' . LemonSqueezy::VERSION)
            ->accept('application/vnd.api+json')
            ->contentType('application/vnd.api+json')
            ->{$METHOD}(config('lemon_squeezy.baseUrl') . "/{$URI}", $PAYLOAD);


    }

    /**
     * @param Response $response
     * @return array
     * @throws JsonException
     */
    public function decodeResponse(Response $response): array
    {
        return json_decode(json: $response->json(), associative: true, flags: JSON_THROW_ON_ERROR);
    }}

<?php

namespace App\Classes;

use App;
use GuzzleHttp\Promise\PromiseInterface;
use JustCommunication\TinkoffAcquiringAPIClient\API\RequestInterface;
use \JustCommunication\TinkoffAcquiringAPIClient\TinkoffAcquiringAPIClient;

class TinkoffAPIClient extends TinkoffAcquiringAPIClient
{
    const TEST_API_ENDPOINT = 'https://rest-api-test.tinkoff.ru/v2';

    public function createAPIRequestPromise(RequestInterface $request): PromiseInterface
    {
        $params = $request->createHttpClientParams();

        if (!isset($params['base_uri'])) {
            if (!App::isProduction()) {
                $params['base_uri'] = self::TEST_API_ENDPOINT;
            } else {
                $params['base_uri'] = self::API_ENDPOINT;
            }
        }

        if (!isset($params['json'])) {
            $params['json'] = [];
        }

        $params['json']['TerminalKey'] = $this->terminal_key;
        $params['json']['Token'] = $this->generateToken($params['json']);

        return $this->httpClient->requestAsync($request->getHttpMethod(), $request->getUri(), $params);
    }
}

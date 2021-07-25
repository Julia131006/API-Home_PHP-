<?php

namespace src\Clients;

use GuzzleHttp\Client;
use src\Clients\HttpClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use src\Exceptions\ApiHttpClientException;

class GuzzleAdapter implements HttpClientInterface
{
    private Client $client;

    public function __construct(){
        $this->client = new Client(['headers' => ['x-api-key' => 'ac4835d5-b62e-413d-8c3b-b2fd5ec2ba1c']]);
    }

    /**
     * @inheritDoc
     */
    public function get(string $uri): ?array{
        try{

            return json_decode($this->client->get($uri)->getBody()->getContents(), true);
        } catch (GuzzleException $e){
            throw new ApiHttpClientException($e->getMessage(), $e->getCode());
        }

    }
    /**
     * @inheritDoc
     */
    public function post(string $uri, $data = []): ?array{

        throw new \BadMethodCallException("Метод не може бути викликаний");
    }
    /**
     * @inheritDoc
     */
    public function delete(string $uri): ?array{

        throw new \BadMethodCallException("Метод не може бути викликаний");
    }

}
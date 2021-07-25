<?php

namespace src\Clients;
 use src\Exceptions\ApiHttpClientException;

interface HttpClientInterface {
    /**
     * @param string $uri
     * @return array|null
     * @throw ApiHttpClientException
     */
    public function get(string $uri): ?array;


    /**
     * @param string $uri
     * @param array $data
     * @return array|null
     * @throw ApiException
     */
    public function post(string $uri, $data = []): ?array;


    /**
     * @param string $uri
     * @return array|null
     * @throw ApiException
     */
    public function delete(string $uri): ?array;
}
<?php

namespace src\Decorator;

use src\Clients\HttpClientInterface;
use src\Decorator\LogDecorator;
use src\Decorator\CacheDecorator;
class MiddleDecorator implements HttpClientInterface
{
    private $client;
    private $log;
    private $cache;


    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;  
        $this->log = new LogDecorator; 
        $this-> cache = CacheDecorator::getInstanse();    
    }
    public function get(string $uri): ?array
    {
        $this->log->save("REQUEST", $uri);

        if($response = $this->cache->get($uri)){
            $this->log->save('CACHE', $uri, $response);
        } else {
            $response = $this->client->get($uri);
            $this->cache->set($uri, $response);
            $this->log->save('RESPONSE', $uri, $response);
        }
        return $response;
    }
    public function post(string $uri, $data =[]): ?array
    {
        return $this->client->post($uri, $data);
    }
    public function delete(string $uri): ?array
    {
        return $this->client->delete($uri);
    }

}
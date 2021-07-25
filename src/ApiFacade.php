<?php

namespace src;

use BadMethodCallException;
use src\Clients\HttpClientInterface;

class ApiFacade
{
    private HttpClientInterface $client;
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;        
    }

    public function __call($name, $arguments)
    {
        
        $className = sprintf('src\\APIs\\%sApi', ucfirst($name));

        if(!class_exists($className)){
            throw new BadMethodCallException('Wrong api ...');
        }

        return new $className($this->client, ...$arguments);
    }
}
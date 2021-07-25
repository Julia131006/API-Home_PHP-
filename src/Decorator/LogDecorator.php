<?php

namespace src\Decorator;

class LogDecorator
{

    public function save(string $method, string $uri, $response = []):void
    {
        if($response){
            file_put_contents('log.json', sprintf("%s: %s, %s\n",
                $method,
                $uri,
                json_encode($response)   
        ), FILE_APPEND);
        } else {
            file_put_contents('log.json', sprintf("%s: %s\n",
                $method,
                $uri,   
        ), FILE_APPEND);
        }
    }
}
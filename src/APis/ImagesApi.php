<?php

namespace src\APIs;

// use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use src\Exceptions\ApiException;
use src\Clients\HttpClientInterface;
use src\Builders\ImagesResultsBuilder;

class ImagesApi{

    /**
     * 
     */
    private HttpClientInterface $client;

    //Interface 
    //Facade
    public function __construct(HttpClientInterface $client)
    {
      $this->client = $client;
    }
    public function search(int $limit = 5, int $page = 0, string $order = 'DESC'){
        
        $uri = sprintf(
          'https://api.thecatapi.com/v1/images/search?limit=%d&page=&d&order=&s',
          $limit,
          $page,
          $order 
        );
          
          //Уніфікацію респонса
          return (new ImagesResultsBuilder($this->client->get($uri)))->build();
    }
}
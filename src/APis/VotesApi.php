<?php

namespace src\APIs;

use GuzzleHttp\Exception\GuzzleException;
use src\Exceptions\ApiException;
use src\Clients\HttpClientInterface;
use src\Builders\VotesResultsBuilder;

class VotesApi{

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
    public function search(int $limit = 5, int $page = 0){
        
        $uri = sprintf(
          'https://api.thecatapi.com/v1/votes?limit=%d&page=&d',
          $limit,
          $page,
        );
      
          //перевірити кеш
          // логування роботи АПІ клієнта 
          $result = $this->client->get($uri);
          
          //Уніфікацію респонса
          return (new VotesResultsBuilder($this->client->get($uri)))->build();

        

    }
}
<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\APIs\VotesApi;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use src\Exceptions\ApiException;
use src\Clients\HttpClientInterface;
use src\Models\Vote;

class VotessApiTests extends TestCase{
    
    const VOTES_RESPONSE = <<<'RESPONSE'
    [
        {
          "country_code": null,
          "created_at": "2018-10-24T08:36:13.000Z",
          "id": 31098,
          "image_id": "43u",
          "sub_id": null,
          "value": 1
        },
        {
          "country_code": null,
          "created_at": "2018-10-24T08:36:16.000Z",
          "id": 31099,
          "image_id": "4lo",
          "sub_id": null,
          "value": 0
        },
        {
          "country_code": null,
          "created_at": "2018-10-24T08:36:21.000Z",
          "id": 31100,
          "image_id": "8rm",
          "sub_id": null,
          "value": 1
        },
        {
          "country_code": null,
          "created_at": "2018-10-24T08:36:24.000Z",
          "id": 31101,
          "image_id": "8eq",
          "sub_id": null,
          "value": 1
        },
        {
          "country_code": null,
          "created_at": "2018-10-24T08:36:28.000Z",
          "id": 31102,
          "image_id": "39i",
          "sub_id": null,
          "value": 1
        }
      ]
    RESPONSE;
    
    /**
    * @test
    */
    public function we_can_perform_search(){
      $client = $this->createMock(HttpClientInterface::class);
      

      $client->expects($this->once())->method('get')->willReturn(json_decode(self::VOTES_RESPONSE, true));



      $api = new VotesApi($client);

      $result = $api->search();

      $this->assertIsArray($result);
      $this->assertInstanceOf(Vote::class, $result[0]);
    }
    
    /**
    * @test
    */
     public function we_throw_exception()
     {
       $client = $this->createMock(HttpClientInterface::class);
       $client->method('get')->willThrowException(
          $this->createMock(ApiException::class)
       );
       $api = new VotesApi($client);
       $this->expectException(ApiException::class);

       $api->search();
     }


    
    // public function we_throw_exception()
    // {
    //     $client = $this->createMock(HttpClientInterface::class);
    //     $client->method('get')->willThrowException(
    //         $this->createMock(ApiException::class)
    //     );
    //     $api = new ImagesApi($client);
    //     $this->expectException(ApiException::class);

    //     $api->search();

    // }


}
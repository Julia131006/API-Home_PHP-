<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\APIs\ImagesApi;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use src\Exceptions\ApiException;
use src\Clients\HttpClientInterface;
use src\Models\Image;

class ImagesApiTests extends TestCase{
    
    const IMAGES_RESPONSE = <<<'RESPONSE'
        [
            {
              "breeds": [],
              "categories": [
                {
                  "id": 1,
                  "name": "hats"
                }
              ],
              "height": 467,
              "id": "7h3",
              "url": "https://cdn2.thecatapi.com/images/7h3.jpg",
              "width": 433
            },
            {
              "breeds": [],
              "height": 2448,
              "id": "yTCEnudEF",
              "url": "https://cdn2.thecatapi.com/images/yTCEnudEF.jpg",
              "width": 3264
            }
          ]
    RESPONSE;
    
    /**
    * @test
    */
    public function we_can_perform_search(){
      $client = $this->createMock(HttpClientInterface::class);
      

      $client->expects($this->once())->method('get')->willReturn(json_decode(self::IMAGES_RESPONSE, true));



      $api = new ImagesApi($client);

      $result = $api->search();

      $this->assertIsArray($result);
      $this->assertInstanceOf(Image::class, $result[0]);
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
       $api = new ImagesApi($client);
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
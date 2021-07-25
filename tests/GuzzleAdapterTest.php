<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use src\Clients\GuzzleAdapter;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use ReflectionClass;
use BadMethodCallException;
use src\Exceptions\ApiHttpClientException;


class GuzzleAdapterTest extends TestCase
{
    /**
     * @test
     * @dataProvider requestDataProvider
     * 
     * @param $method
     * @param array $data
     * @throw ReflectionException 
     */
    public function we_can_make_request($method, array $data){
        $client = new GuzzleAdapter;
        $guzzleMock = $this->createMock(Client::class);
        $guzzleMock->expects($this->once())->method($method)->willReturnCallback(function(){
            $response = $this->createMock(ResponseInterface::class);
            $response->method('getBody')->willReturnCallback(function(){
            $stream = $this->createMock(StreamInterface::class);
            $stream->method('getContents')->willReturn('');
            return $stream;
        });

        return $response;

      });
      $this->setProperty($client, 'client', $guzzleMock);
      $this->assertNull($client->$method(...$data));
    }

    /**
     * 
     * @param $object
     * @param $property
     * @param $value
     * @throw ReflectionException 
     */
    public function setProperty($object, $property, $value)
    {
        $reflectionClass = new ReflectionClass($object);
        $reflection = $reflectionClass->getProperty($property);
        $reflection->setAccessible(true);
        $reflection->setValue($object, $value);
    }

    /**
     * @return array
     */

     public function requestDataProvider()
     {
        return [
            ['get', ['uri']]
        ];
     }


      /**
     * @test
     * @dataProvider exceptionDataProvider
     * 
     * @param $method
     * @param array $data
     * @param $expected
     * @throw ReflectionException 
     */
     public function we_can_throw_exception($method, array $data, $expected)
     {
        $client = new GuzzleAdapter;

        $guzzleMock = $this->createMock(Client::class);
        $guzzleMock->method($method)->willThrowException($this->createMock(GuzzleException::class));
        $this->setProperty($client, 'client', $guzzleMock);

        $this->expectException($expected);

        $client->$method(...$data);
     }

     /**
      * return array
      */
      public function exceptionDataProvider(){
          return [
              ['get', ['uri'], ApiHttpClientException::class],
              ['post', ['uri'], BadMethodCallException::class],
              ['delete', ['uri'], BadMethodCallException::class]
          ];
      }
     
}
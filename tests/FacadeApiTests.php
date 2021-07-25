<?php

namespace tests;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use src\APIs\ImagesApi;
use src\Clients\HttpClientInterface;
use src\ApiFacade;

class FacadeApiTest extends TestCase
{
    /**
     * @test
     */
    public function we_call_facade()
    {
        $client = $this->createMock(HttpClientInterface::class);

        $facade = new ApiFacade($client);

        $this->assertInstanceOf(ImagesApi::class, $facade->images());

    }

    /**
     * @test
     */
    public function we_throw_exception(){
        $client = $this->createMock(HttpClientInterface::class);
        $facade = new ApiFacade($client);
        $this->expectException(BadMethodCallException::class);
        $facade->bad_method();

    }

} 
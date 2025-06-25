<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HelloWorldControllerTest extends WebTestCase
{
    public function testHelloWorld(): void
    {
        $client = static::createClient();
        $client->request('GET', '/hello');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('content-type', 'text/html; charset=UTF-8');
        $this->assertSelectorTextContains('body', 'Hello World!');
    }
}
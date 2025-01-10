<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HealthCheckActionTest extends WebTestCase
{
    public function test_respons_get_successfull_result()
    {
        $client = static::createClient();
        $client->request('GET', '/health-check');

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');
        $content = $client->getResponse()->getContent();
        $this->assertJson($content);
        $json = json_decode($content, true);
        $this->assertArrayHasKey('status', $json);
        $this->assertEquals('ok', $json['status']);


    }
}

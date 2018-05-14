<?php

namespace Tests\Feature;

use Tests\AutomatedTestTrait;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AutomatedTest extends TestCase
{

    use AutomatedTestTrait;

    public function testAdmin()
    {
        //$this->login('admin');
        $client = $this->get('/');
        if (302 === $client->getStatusCode()) {
        } else {
            $this->assertEquals(200, $client->getStatusCode(), '/');
            $response = $client->baseResponse->getContent();
            $this->checkAllLinks($response);
        }

    }
}

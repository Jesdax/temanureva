<?php

namespace App\Tests;


use App\Entity\Observation;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PagesTest extends WebTestCase
{

    /**
     * @param $method
     * @param $path
     * @param $expectedResult
     * @dataProvider findMethod
     */
    public function testUp($method, $path, $expectedResult)
    {

        $client = static::createClient();
        $client->request($method, $path);

        $this->assertSame($expectedResult, $client->getResponse()->getStatusCode());

    }

    public function findMethod()
    {
        return [
        ['GET', '/amis-oiseaux-articles-blog-information/1', 500],
        ['GET', '/inscription', 200]
        ];
    }

}
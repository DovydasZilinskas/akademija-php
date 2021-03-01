<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmailListControllerTest extends WebTestCase
{
    public function testGetEmails()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('admin@admin');

        $client->loginUser($testUser);

        $client->request('GET', '/getemail');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGetNameResults()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('admin@admin');

        $client->loginUser($testUser);

        $client->request('GET', '/getemail?name=Dovy');

        $expected = count(json_decode($client->getResponse()->getContent()));

        $this->assertEquals(3, $expected);
    }

    public function testFilterResults()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('admin@admin');

        $client->loginUser($testUser);

        $client->request('GET', '/getemail?name=Dovy&email=email');

        $expected = count(json_decode($client->getResponse()->getContent()));

        $this->assertEquals(2, $expected);
    }

    public function testGetMessageResults()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('admin@admin');

        $client->loginUser($testUser);

        $client->request('GET', '/getemail?message=spinner');

        $data = '[{"id":227614,"name":"Dovydas","email":"email@email","message":"test spinner","createdAt":"2021-02-24T17:05:23+00:00"}]';

        $this->assertEquals($data, $client->getResponse()->getContent());
    }

    public function testArrayResult()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('admin@admin');

        $client->loginUser($testUser);

        $client->request('GET', '/getemail?name=dovy&message=kazkas');

        $data = [[
            'id' => 227615,
            'name' => 'Dovydas',
            'email' => 'test@email2',
            'message' => 'kazkas',
            'createdAt' => '2021-02-25T00:00:00+00:00'
        ]];

        $actualData = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals($data, $actualData);
    }
}

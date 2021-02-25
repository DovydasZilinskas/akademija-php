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

        $data = '[{"id":227614,"name":"Dovydas","email":"email@email","message":"test spinner","createdAt":"2021-02-24T17:05:23+00:00"}]';

        $this->assertEquals($data, $client->getResponse()->getContent());
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

    public function testGetEmailResults()
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);

        $testUser = $userRepository->findOneByEmail('admin@admin');

        $client->loginUser($testUser);

        $client->request('GET', '/getemail?email=email@email');

        $data = '[{"id":227614,"name":"Dovydas","email":"email@email","message":"test spinner","createdAt":"2021-02-24T17:05:23+00:00"}]';

        $this->assertEquals($data, $client->getResponse()->getContent());
    }
}

<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/contact');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $form = $crawler->filter('form')->form();

        $form->setValues(['contact[fullName]' => 'Dovydas', 'contact[email]' => 'test@test.ru', 'contact[message]' => 'TEST']);

        $crawler = $client->submit($form);

        $this->assertEmailCount(1);

        $email = $this->getMailerMessage(0);

        $this->assertEmailHeaderSame($email, 'From', 'info@info.info');
        $this->assertEmailHeaderSame($email, 'To', 'test@test.ru');

        $this->assertEmailTextBodyContains($email, 'TEST');
    }
}

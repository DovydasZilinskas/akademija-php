<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        // $crawler = $client->request('GET', '/contact');
        
        // $form = $crawler->filter('form')->form();

        // $form->setValues(['contact[fullName]' => 'Dovydas', 'contact[email]' => 'test@test', 'contact[message]' => 'TEST']);

        $content = '
        {
            "fullName": "Dovydas",
            "email": "test@test",
            "message": "labas"
        }
        ';

        $client->request('POST', '/contactpost', ['headers' => ['Content-Type' => 'application/json']], [], [], $content);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // $crawler = $client->submit($form);

        $this->assertEmailCount(1);

        $email = $this->getMailerMessage(0);

        $this->assertEmailHeaderSame($email, 'From', 'info@info.info');
        $this->assertEmailHeaderSame($email, 'To', 'test@test');

        $this->assertEmailTextBodyContains($email, 'TEST');
    }
}

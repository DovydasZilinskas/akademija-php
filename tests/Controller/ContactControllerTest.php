<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ContactControllerTest extends WebTestCase
{
    // public function testShowPost()
    // {
    //     $client = static::createClient();

    //     // $crawler = $client->request('GET', '/contact');
        
    //     // $form = $crawler->filter('form')->form();

    //     // $form->setValues(['contact[fullName]' => 'Dovydas', 'contact[email]' => 'test@test', 'contact[message]' => 'TEST']);

    //     $content = '
    //     {
    //         "fullName": "Name",
    //         "email": "test@test",
    //         "message": "TEST"
    //     }
    //     ';

    //     $client->request('POST', '/contactpost', [], [], ['CONTENT_TYPE' => 'application/json'], $content);

    //     $this->assertEquals(200, $client->getResponse()->getStatusCode());

    //     // $crawler = $client->submit($form);

    //     $this->assertEmailCount(1);

    //     $email = $this->getMailerMessage(0);

    //     $this->assertEmailHeaderSame($email, 'From', 'info@info.info');
    //     $this->assertEmailHeaderSame($email, 'To', 'test@test');

    //     $this->assertEmailTextBodyContains($email, 'TEST');
    // }

    public function testGetErrors()
    {
        $client = static::createClient();

        $content = '
        {
            "fullName": "",
            "email": "",
            "message": "",
            "captcha": "wrong"
        }
        ';

        $client->request('POST', '/contactpost', [], [], ['CONTENT_TYPE' => 'application/json'], $content);

        $response = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals([
            "data.fullName" => "This value should not be blank.",
            "data.email" => "This value should not be blank.",
            "data.message" => "This value should not be blank.",
        ], $response);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());

        $this->assertEmailCount(0);
    }
}

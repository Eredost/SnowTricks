<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    /**
     * Test if the account validation process failed if the email and token are missing
     */
    public function testValidationPageAccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/user/validate');

        self::assertTrue($client->getResponse()->isRedirection());
    }
}

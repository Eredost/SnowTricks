<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    /**
     *  Test if the valid routes of the SecurityController are accessible for any user
     *
     * @dataProvider provideValidUrls
     *
     * @param $url
     */
    public function testValidPageAccess($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        self::assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * Test if the given routes redirect the client
     *
     * @dataProvider provideRedirectUrls
     *
     * @param $url
     */
    public function testRedirectedPageAccess($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        self::assertTrue($client->getResponse()->isRedirection());
    }

    /**
     * @return array
     */
    public function provideValidUrls(): array
    {
        return [
            ['/login'],
            ['/signup'],
            ['/ask-reset'],
        ];
    }

    /**
     * @return array
     */
    public function provideRedirectUrls(): array
    {
        return [
            ['/logout'],
            ['/reset-password']
        ];
    }
}

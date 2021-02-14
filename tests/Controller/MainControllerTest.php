<?php


namespace App\Tests\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    /**
     *  Test if the routes of the MainController are accessible for any user
     *
     * @dataProvider provideUrls
     *
     * @param $url
     */
    public function testPagesAccess($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        self::assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * Provide all MainController urls
     *
     * @return array
     */
    public function provideUrls(): array
    {
        return [
            ['/'],
        ];
    }
}

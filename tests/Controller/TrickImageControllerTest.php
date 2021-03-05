<?php


namespace App\Tests\Controller;


use App\Repository\TrickImageRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickImageControllerTest extends WebTestCase
{
    /**
     * Test if protected routes are not accessible for anonymous users
     *
     * @dataProvider provideProtectedUrls
     *
     * @param $url
     * @param $method
     */
    public function testUnauthorizedPageAccess($url, $method = 'GET'): void
    {
        $client = static::createClient();

        $trickImageRepository = static::$container->get(TrickImageRepository::class);
        $trickImage = $trickImageRepository->findOneBy([]);

        $url = preg_replace('/{id}/i', $trickImage->getId(), $url);
        $client->request($method, $url);

        self::assertTrue($client->getResponse()->isRedirection());
    }

    /**
     * @return array
     */
    public function provideProtectedUrls(): array
    {
        return [
            ['/trick-image/{id}/edit'],
            ['/trick-image/{id}', 'DELETE'],
        ];
    }
}

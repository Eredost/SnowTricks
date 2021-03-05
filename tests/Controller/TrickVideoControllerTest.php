<?php


namespace App\Tests\Controller;


use App\Repository\TrickVideoRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickVideoControllerTest extends WebTestCase
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

        $trickVideoRepository = static::$container->get(TrickVideoRepository::class);
        $trickVideo = $trickVideoRepository->findOneBy([]);

        $url = preg_replace('/{id}/i', $trickVideo->getId(), $url);
        $client->request($method, $url);

        self::assertTrue($client->getResponse()->isRedirection());
    }

    /**
     * @return array
     */
    public function provideProtectedUrls(): array
    {
        return [
            ['/trick-video/{id}/edit'],
            ['/trick-video/{id}', 'DELETE'],
        ];
    }
}

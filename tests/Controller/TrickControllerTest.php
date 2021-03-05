<?php


namespace App\Tests\Controller;


use App\DataFixtures\Providers\UserProvider;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TrickControllerTest extends WebTestCase
{
    /**
     * Test if the detail page of a figure is accessible to everyone
     */
    public function testFigureDetailPageAccess(): void
    {
        $client = static::createClient();
        $client->request('GET', '/trick/Ollie');

        self::assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * Test if protected routes are not accessible to anonymous users
     *
     * @dataProvider provideProtectedUrls
     *
     * @param $url
     */
    public function testUnauthorizedPageAccess($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);

        self::assertTrue($client->getResponse()->isRedirection());
    }

    /**
     * Test if protected routes are accessible to logged users
     *
     * @dataProvider provideProtectedUrls
     *
     * @param $url
     */
    public function testProtectedPageAccess($url): void
    {
        $client = static::createClient();

        $userRepository = static::$container->get(UserRepository::class);
        $userCredentials = UserProvider::getTestUsers()[0];
        $testUser = $userRepository->findOneBy(['username' => $userCredentials['username']]);

        $client->loginUser($testUser);
        $client->request('GET', $url);

        self::assertTrue($client->getResponse()->isSuccessful());
    }

    /**
     * @return array
     */
    public function provideProtectedUrls(): array
    {
        return [
            ['/trick/new'],
            ['/trick/Ollie/edit'],
        ];
    }
}

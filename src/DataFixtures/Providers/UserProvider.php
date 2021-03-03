<?php


namespace App\DataFixtures\Providers;


class UserProvider
{
    /**
     * Contains all users for test purposes
     *
     * @var array[]
     */
    private const TEST_USERS = [
        [
            'username'  => 'test',
            'email'     => 'test@snowtricks.fr',
            'password'  => 'L4hA5tcRS4yBcJLp',
            'roles'     => ['ROLE_USER'],
        ],
    ];

    /**
     * @return array[]
     */
    public static function getTestUsers(): array
    {
        return static::TEST_USERS;
    }
}

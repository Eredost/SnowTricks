<?php


namespace App\DataFixtures\Providers;


class UserProvider
{
    /**
     * Contains all users with administrator privileges
     *
     * @var array[]
     */
    private const ADMIN_USERS = [
        'admin' => [
            'email'    => 'admin@snowtricks.fr',
            'password' => 'L4hA5tcRS4yBcJLp',
            'role'     => 'ROLE_ADMIN',
        ]
    ];

    /**
     * @return array[]
     */
    public static function getAdminUsers()
    {
        return static::ADMIN_USERS;
    }
}

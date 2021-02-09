<?php

namespace App\DataFixtures;

use App\DataFixtures\Providers\UserProvider;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends AbstractFixture
{
    /** @var UserPasswordEncoderInterface $encoder */
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    protected function loadData(ObjectManager $manager): void
    {
        $admins = UserProvider::getAdminUsers();

        // Add users with administrator privileges
        $this->createMany(count($admins), 'admin_user', function ($count) use ($admins) {
            $admin = (new User())
                ->setUsername($admins[$count]['username'])
                ->setEmail($admins[$count]['email'])
                ->setRoles($admins[$count]['roles'])
                ->setIsValidated(true)
            ;
            $admin->setPassword($this->encoder->encodePassword($admin, $admins[$count]['password']));

            return $admin;
        });

        // Add simple users
        $this->createMany(5, 'main_user', function ($count) {
            $user = (new User())
                ->setUsername($this->faker->userName)
                ->setEmail($this->faker->safeEmail)
                ->setRoles(['ROLE_USER'])
                ->setIsValidated(true)
            ;
            $user->setPassword($this->encoder->encodePassword($user, 'password'));

            return $user;
        });

        $manager->flush();
    }
}

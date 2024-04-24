<?php

namespace App\DataFixtures;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $data = [
            'eautarie',
            'toto',
            'tata',
            'pass_1234_',
            ];
        for ($i=0; $i<10; $i++) {
            $user = new User();
            $user->setUsername($data[0]. $i);
            $user->setFirstname($data[1]. $i);
            $user->setLastname($data[2]. $i);
            $user->setEmail('tototata'.$i. '@example.com');
            if ($i%2 !=0) {
                $user->setRoles(['ROLE_ADMIN, ROLE_USER']);
                $user->setVerified(1);
            } else {
                $user->setRoles(['ROLE_USER']);
                $user->setVerified(0);
            }

            $password = $this->hasher->hashPassword($user, $data[3]. $i);
            $user->setPassword($password);
            $user->setCreatedAt(
                (new \DateTimeImmutable("now"))->setTimezone(new \DateTimeZone('Europe/Paris'))
            );
            $user->setUpdatedAt(
                (new \DateTimeImmutable("now"))->setTimezone(new \DateTimeZone('Europe/Paris'))
            );
            $user->setLastLogin(
                (new \DateTimeImmutable("now"))->setTimezone(new \DateTimeZone('Europe/Paris'))
            );
            $user->setPasswordRequested(0);
            $user->setPasswordResetCounter(0);
            $manager->persist($user);
        }

        $manager->flush();
    }
}

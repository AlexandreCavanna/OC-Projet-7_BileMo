<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 100, function (User $user) {
            $user->setEmail($this->faker->email());
            $user->setCreatedAt($this->faker->dateTime());
            $user->setFirstname($this->faker->firstName());
            $user->setLastname($this->faker->lastName());
            $user->setCustomer($this->getRandomReference(Customer::class));
        });

        $manager->flush();
    }
}

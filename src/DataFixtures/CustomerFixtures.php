<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerFixtures extends BaseFixture
{
    private UserPasswordHasherInterface $passwordHasher;

    /**
     * CustomerFixtures constructor.
     * @param \Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    protected function loadData(ObjectManager $manager)
    {

        $this->createMany(Customer::class, 30, function (Customer $customer) {
            $customer->setEmail($this->faker->email());
            $customer->setPassword($this->passwordHasher->hashPassword($customer, 'password'));
            $customer->setRoles(['ROLE_USER']);
            $customer->setCompany($this->faker->company());

        });

        $manager->flush();
    }
}

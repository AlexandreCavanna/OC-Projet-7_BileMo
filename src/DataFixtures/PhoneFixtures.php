<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Persistence\ObjectManager;

class PhoneFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Phone::class, 30, function (Phone $phone) {
            $phone->setBuildNumber($this->faker->deviceBuildNumber());
            $phone->setManufacturer($this->faker->deviceManufacturer());
            $phone->setModelName($this->faker->deviceModelName());
            $phone->setOperatingSystem($this->faker->devicePlatform());
            $phone->setSerialNumber($this->faker->deviceSerialNumber());
            $phone->setVersion($this->faker->deviceVersion());
        });

        $manager->flush();
    }
}

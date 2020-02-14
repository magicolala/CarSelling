<?php

namespace App\DataFixtures;

use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = (new \Faker\Factory())::create('fr_FR');
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        for ($i=0; $i < 500; $i++) {
            $car = new Car();
            $vehicule = $faker->vehicleArray;
            $car
                ->setBoiteDeVitesse($faker->vehicleGearBoxType)
                ->setCategory($faker->vehicleType)
                ->setBrand($vehicule['brand'])
                ->setModel($vehicule['model'])
                ->setCity($faker->city)
                ->setPrix($faker->numberBetween(800, 5000))
                ->setEnergie($faker->vehicleFuelType)
                ->setNbPorte($faker->vehicleDoorCount)
                ->setNbPlace($faker->vehicleSeatCount)
                ->setDescription($faker->paragraph)
                ->setNote($faker->numberBetween(0,5))
                ->setKilometrage($faker->numberBetween(8000,200000))
                ->setYear($faker->numberBetween(1999,2019));
                $manager->persist($car);
        }

        $manager->flush();
    }
}

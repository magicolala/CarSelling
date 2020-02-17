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

        for ($i=0; $i < 4000; $i++) {
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
                ->setDescription($faker->paragraph)
                ->setNote($faker->numberBetween(0,5))
                ->setKilometrage($faker->numberBetween(8000,200000))
                ->setYear($faker->numberBetween(1999,2019))
                ->setIsSelling($faker->boolean)
                ->setIsPublished($faker->boolean)
                ->setImg('https://www.hyundaimagog.com/wp-content/uploads/medias/hyundai/ioniq-hybride-2019/trims/argent-platine-0.png')
                ->setCreatedAt($faker->dateTimeBetween('-2 years', 'now'));

                $manager->persist($car);
        }

        $manager->flush();
    }
}

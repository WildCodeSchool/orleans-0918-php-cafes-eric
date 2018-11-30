<?php
/**
 * Created by PhpStorm.
 * User: wilder11
 * Date: 30/11/18
 * Time: 09:58
 */

namespace App\DataFixtures;

use App\Entity\Worker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class WorkerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($w=0; $w<3; $w++) {
            $faker = Faker\Factory::create('fr_FR');
            $worker = new Worker();
            $worker->setName($faker->firstname);
            $worker->setDescription($faker->text($maxNbChars = 200));
            $manager->persist($worker);
        }
        $manager->flush();
    }
}

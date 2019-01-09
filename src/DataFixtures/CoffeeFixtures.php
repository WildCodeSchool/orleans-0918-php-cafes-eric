<?php
/**
 * Created by PhpStorm.
 * User: wilder11
 * Date: 30/11/18
 * Time: 09:58
 */

namespace App\DataFixtures;

use App\Entity\Coffee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CoffeeFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($w=0; $w<10; $w++) {
            $coffee = new Coffee();
            $coffee->setCountry($faker->countryCode);
            $coffee->setUpdatedAt(new \DateTime());
            $coffee->setSoil($faker->word);
            $coffee->setVariety($faker->word);
            $coffee->setTastingNote($faker->word);
            $coffee->setDescription($faker->text);
            $coffee->setHighlighted(0);
            $coffee->setNovelty(0);
            $coffee->setCoffeeImage('');
            $coffee->setCategory($this->getReference('categ_COFFEE' .'_'.floor($w/2)));

            $manager->persist($coffee);
        }
        $manager->flush();
    }
}

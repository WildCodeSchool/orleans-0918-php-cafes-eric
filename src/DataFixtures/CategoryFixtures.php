<?php
/**
 * Created by PhpStorm.
 * User: amadrocky
 * Date: 29/11/18
 * Time: 11:18
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [ShelfFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');
        for ($n=0; $n<5; $n++) {
            for ($i = 1; $i <= 6; $i++) {
                $category = new Category();
                $category->setTitle(rtrim($faker->sentence(2, true), '.'));

                $manager->persist($category);
                $category->setShelf($this->getReference('rayon_'. $n));
            }
        }
        $manager->flush();
    }
}

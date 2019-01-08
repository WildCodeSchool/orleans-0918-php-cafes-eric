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
        for ($n=0; $n<3; $n++) {
            for ($i = 0; $i < 5; $i++) {
                $category = new Category();
                $category->setTitle(rtrim($faker->sentence(2, true), '.'));

                $manager->persist($category);
                $shelf = $this->getReference('rayon_'. $n);
                $category->setShelf($shelf);
                $this->addReference('categ_'.$shelf->getShelfCode().'_'.$i, $category);
            }
        }
        $manager->flush();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: wilder11
 * Date: 30/11/18
 * Time: 09:58
 */

namespace App\DataFixtures;

use App\Entity\Coffee;
use App\Entity\FamilyTea;
use App\Entity\Tea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TeaFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i<5; $i++) {
            $familyTea[$i] = new FamilyTea();
            $familyTea[$i]->setName($faker->words(3, true));
            $manager->persist($familyTea[$i]);
        }

        for ($w=0; $w<10; $w++) {
            $tea = new Tea();
            $tea->setName($faker->word);
            $tea->setIngredients($faker->words(4, true));
            $tea->setFeature($faker->word);
            $tea->setHighlighted(0);
            $tea->setNovelty(0);
            $tea->setFamilyTea($familyTea[floor($w/2)]);
            $tea->setCategory($this->getReference('categ_TEA' .'_'.floor($w/2)));

            $manager->persist($tea);
        }
        $manager->flush();
    }
}

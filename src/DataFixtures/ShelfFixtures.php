<?php
/**
 * Created by PhpStorm.
 * User: amadrocky
 * Date: 29/11/18
 * Time: 10:56
 */

namespace App\DataFixtures;

use App\Entity\Shelf;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ShelfFixtures extends Fixture
{
    /**
     * @var array
     */
    private $shelf = [
        'COFFEE'=>'Cafés',
        'TEA'=>'Thés',
        'INFUSION'=>'Infusions',
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $key = 0;

        foreach ($this->shelf as $shefCode => $shelfTitle) {
            $shelf = new Shelf();
            $shelf->setTitle($shelfTitle);
            $shelf->setShelfCode($shefCode);
            $manager->persist($shelf);
            $this->addReference('rayon_' . $key, $shelf);
            $key++;
        }

        $manager->flush();
    }
}

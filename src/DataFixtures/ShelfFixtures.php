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
        'Cafés',
        'Thés',
        'Infusions',
        'Épicerie',
        'Accessoires'
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->shelf as $key => $shelfTitle) {
            $shelf = new Shelf();
            $shelf->setTitle($shelfTitle);
            $manager->persist($shelf);
            $this->addReference('rayon_' . $key, $shelf);
        }
        $manager->flush();
    }
}

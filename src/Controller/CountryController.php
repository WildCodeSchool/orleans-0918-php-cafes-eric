<?php
/**
 * Created by PhpStorm.
 * User: wilder5
 * Date: 12/12/18
 * Time: 14:39
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Intl\Intl;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CountryController extends AbstractController
{
    /**
     * @return string|null
     */
    public function getCountryName()
    {
        return Intl::getRegionBundle()->getCountryName($this->getCountry());
    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccessoryController extends AbstractController
{
    /**
     * @Route("/accessory", name="accessory")
     */
    public function index()
    {
        return $this->render('accessory/index.html.twig');
    }
}

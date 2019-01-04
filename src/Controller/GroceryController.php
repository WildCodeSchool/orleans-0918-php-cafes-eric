<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GroceryController extends AbstractController
{
    /**
     * @Route("/grocery", name="grocery")
     */
    public function index()
    {
        return $this->render('grocery/index.html.twig');
    }
}

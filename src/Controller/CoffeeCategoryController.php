<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoffeeCategoryController extends AbstractController
{
    /**
     * @Route("/coffee/category", name="coffee_category")
     */
    public function index()
    {
        return $this->render('coffee_category/index.html.twig', [
            'controller_name' => 'CoffeeCategoryController',
        ]);
    }
}

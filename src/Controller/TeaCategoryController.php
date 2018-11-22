<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeaCategoryController extends AbstractController
{
    /**
     * @Route("/tea/category", name="tea_category")
     */
    public function index()
    {
        return $this->render(
            'tea_category/index.html.twig',
            [
            'controller_name' => 'TeaCategoryController',
              ]
        );
    }
}

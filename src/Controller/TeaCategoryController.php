<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeaCategoryController extends AbstractController
{
    /**
     * @Route("/tea/category", name="teaCategory")
     */
    public function index()
    {
        return $this->render(
            'teaCategory/index.html.twig'
        );
    }
}
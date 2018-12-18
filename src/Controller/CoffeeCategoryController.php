<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

class CoffeeCategoryController extends AbstractController
{
    /**
     * @Route("/coffee/category", name="coffee_category")
     */
    public function index(CategoryRepository $categoryRepository)
    {
        return $this->render('coffee_category/index.html.twig', [
            'controller_name' => 'CoffeeCategoryController',
            'categories' => $categoryRepository->findByShelf(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\ShelfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;

class CoffeeCategoryController extends AbstractController
{
    /**
     * @Route("/coffee/category", name="coffee_category")
     */
    public function index(CategoryRepository $categoryRepository, ShelfRepository $shelfRepository)
    {
        $shelf = $shelfRepository->findOneBy(['shelfCode' => 'COFFEE']);

        return $this->render('coffee_category/index.html.twig', [
            'controller_name' => 'CoffeeCategoryController',
            'categories' => $categoryRepository->findBy(['shelf' => $shelf->getId()]),
        ]);
    }
}

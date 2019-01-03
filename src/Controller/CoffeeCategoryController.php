<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CoffeeRepository;

class CoffeeCategoryController extends AbstractController
{
    /**
     * @Route("/coffee/category", name="coffee_category")
     * @param CoffeeRepository $coffeeRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(CoffeeRepository $coffeeRepository)
    {
        $coffees = $coffeeRepository->findBy([], ['country'=>'ASC']);
        foreach ($coffees as $coffee) {
            $country = $coffee->getCountry();
            $category = $coffee->getCategory()->getTitle();
            $coffeeByArea[$category][$country][] = $coffee;
        }

        return $this->render('coffee_category/index.html.twig', [
            'coffeeByArea'=>$coffeeByArea,
        ]);
    }
}

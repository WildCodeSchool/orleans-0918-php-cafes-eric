<?php

namespace App\Controller;

use App\Entity\Coffee;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
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
        $coffeeByArea = [];

        foreach ($coffees as $coffee) {
            $country = $coffee->getCountry();
            $category = $coffee->getCategory()->getTitle();
            $coffeeByArea[$category][$country][] = $coffee;
        }

        return $this->render('coffee_category/index.html.twig', [
            'coffeeByArea'=>$coffeeByArea,
        ]);
    }

    /**
     * @Route("/coffee/{id}", name="coffee_category_show", methods="GET")
     */
    public function show(Coffee $coffee): Response
    {
        return $this->render('coffee_category/show.html.twig', [
            'coffee' => $coffee
        ]);
    }
}

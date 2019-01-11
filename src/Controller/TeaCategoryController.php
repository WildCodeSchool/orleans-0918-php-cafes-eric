<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\FamilyTeaRepository;
use App\Repository\ShelfRepository;
use App\Repository\TeaRepository;
use App\Entity\Tea;
use App\Entity\FamilyTea;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeaCategoryController extends AbstractController
{
    /**
     * @Route("/tea/category", name="tea_category")
     * @param CategoryRepository $categoryRepository
     * @param ShelfRepository $shelfRepository
     */
    public function index(CategoryRepository $categoryRepository, ShelfRepository $shelfRepository) : Response
    {
        $shelf = $shelfRepository->findOneBy(['shelfCode' => 'TEA']);
        $categories = $categoryRepository->findBy(
            ['shelf' => $shelf]
        );
        return $this->render(
            'teaCategory/index.html.twig',
            [
                'controller_name' => 'TeaCategoryController',
                'categories' => $categories
            ]
        );
    }

    /**
     * @Route("/tea/category/{id}", name="tea_category_show")
     * @param TeaRepository $teaRepository
     * @param FamilyTeaRepository $familyTeaRepository
     */
    public function show(Category $category, TeaRepository $teaRepository): Response
    {
        $teas = $teaRepository->findBy(
            ['category' => $category],
            ['familyTea' => 'ASC']
        );
        $teaByFamilyTea = [];
        foreach ($teas as $tea) {
            $familyTea = $tea->getFamilyTea()->getName();
            $teaByFamilyTea[$familyTea][] = $tea;
        }
        return $this->render('teaCategory/show.html.twig', [
            'teaByFamilyTea' => $teaByFamilyTea,
            'category' => $category,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\ShelfRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\FamilyInfusionRepository;
use App\Repository\InfusionRepository;

class InfusionCategoryController extends AbstractController
{
    /**
     * @Route("/infusion/category", name="infusion_category")
     * @param CategoryRepository $categoryRepository
     * @param ShelfRepository $shelfRepository
     */
    public function index(
        CategoryRepository $categoryRepository,
        ShelfRepository $shelfRepository
    ) : Response {
        $shelf = $shelfRepository->findOneBy(['shelfCode' => 'INFUSION']);
        $categories = $categoryRepository->findBy(
            ['shelf' => $shelf->getId()]
        );
        return $this->render(
            'infusion_category/index.html.twig',
            [
                'controller_name' => 'InfusionCategoryController',
                'categories' => $categories
            ]
        );
    }
    /**
     * @Route("/infusion/category/{id}", name="infusion_category_show")
     * @param InfusionRepository $infusionRepository
     * @param FamilyInfusionRepository $familyInfusionRepository
     */
    public function show(
        Category $category,
        InfusionRepository $infusionRepository
    ): Response {
        $infusions = $infusionRepository->findBy(
            ['category' => $category],
            ['FamilyInfusion' => 'ASC']
        );
        $infusionByFamilyInfusion = [];
        foreach ($infusions as $infusion) {
            $familyInfusion = $infusion->getFamilyInfusion()->getName();
            $infusionByFamilyInfusion[$familyInfusion][] = $infusion;
        }
        dump($infusionByFamilyInfusion);
        return $this->render('infusion_category/show.html.twig', [
            'infusionByFamilyInfusion' => $infusionByFamilyInfusion,
            'category' => $category,
        ]);
    }
}

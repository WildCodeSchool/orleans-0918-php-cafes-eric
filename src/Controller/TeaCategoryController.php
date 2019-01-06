<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\FamilyTeaRepository;
use App\Repository\TeaRepository;
use App\Entity\Tea;
use App\Entity\FamilyTea;
use function PhpParser\filesInDir;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeaCategoryController extends AbstractController
{
    /**
     * @Route("/tea/category", name="tea_category")
     * @param TeaRepository $teaRepository
     * @param FamilyTeaRepository $familyTeaRepository
     */
    public function index(TeaRepository $teaRepository, FamilyTeaRepository $familyTeaRepository)
    {
        $teas = $teaRepository->findBy([],['familyTea'=>'ASC']);
        foreach ($teas as $tea) {
            $category =$tea->getCategory()->getTitle();
            $familyTea= $tea->getFamilyTea()->getName();

            $teabyFamilyTea[$category][$familyTea][]=$tea;
        }
        return $this->render('teaCategory/index.html.twig',[
            'teabyFamilyTea' =>$teabyFamilyTea,

        ]);
    }
}


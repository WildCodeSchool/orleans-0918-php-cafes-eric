<?php

namespace App\Controller;

use App\Repository\CoffeeRepository;
use App\Repository\TeaRepository;
use App\Repository\InfusionRepository;
use App\Repository\WorkerRepository;
use App\Service\MaxProductChecker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        WorkerRepository $workerRepository,
        CoffeeRepository $coffeeRepository,
        TeaRepository $teaRepository,
        InfusionRepository $infusionRepository,
        MaxProductChecker $maxProductChecker
    ) {
        $workers = $workerRepository->findAll();
        $coffees = $coffeeRepository->findByNovelty(true);
        $teas = $teaRepository->findByNovelty(true);
        $infusions = $infusionRepository->findByNovelty(true);
        $noveltySection = $maxProductChecker->countNumbers();


        return $this->render('home/index.html.twig', [
            'workers' => $workers,
            'coffees' => $coffees,
            'teas' => $teas,
            'infusions' => $infusions,
            'noveltySection' => $noveltySection
        ]);
    }
}

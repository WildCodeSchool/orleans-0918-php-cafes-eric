<?php

namespace App\Controller;

use App\Repository\CoffeeRepository;
use App\Repository\TeaRepository;
use App\Repository\InfusionRepository;
use App\Repository\WorkerRepository;
use App\Service\MaxProductChecker;
use App\Repository\AdvertiseRepository;
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
        MaxProductChecker $maxProductChecker,
        AdvertiseRepository $advertiseRepository
    ) {
        $workers = $workerRepository->findAll();
        $coffees = $coffeeRepository->findByNovelty(true);
        $teas = $teaRepository->findByNovelty(true);
        $infusions = $infusionRepository->findByNovelty(true);
        $coffeesMonth = $coffeeRepository->findByHighlighted(true);
        $teasMonth = $teaRepository->findByHighlighted(true);
        $infusionsMonth = $infusionRepository->findByHighlighted(true);
        $noveltySection = $maxProductChecker->countNoveltyNumbers();
        $highlightedSection = $maxProductChecker->countHighlightedNumbers();
        $advertise = $advertiseRepository->findOneBy([]);

        return $this->render('home/index.html.twig', [
            'workers' => $workers,
            'coffees' => $coffees,
            'teas' => $teas,
            'infusions' => $infusions,
            'coffeesMonth' => $coffeesMonth,
            'teasMonth' => $teasMonth,
            'infusionsMonth' => $infusionsMonth,
            'noveltySection' => $noveltySection,
            'highlightedSection' => $highlightedSection,
            'advertise' => $advertise
        ]);
    }
}

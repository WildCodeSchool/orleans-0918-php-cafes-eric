<?php

namespace App\Controller;

use App\Entity\Coffee;
use App\Entity\Infusion;
use App\Entity\Tea;
use App\Entity\Worker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $workers = $this->getDoctrine()
            ->getRepository(Worker::class)
            ->findAll();

        $coffees = $this->getDoctrine()
            ->getRepository(Coffee::class)
            ->findAll();

        $teas = $this->getDoctrine()
            ->getRepository(Tea::class)
            ->findAll();

        $infusions = $this->getDoctrine()
            ->getRepository(Infusion::class)
            ->findAll();

        return $this->render('home/index.html.twig', [
            'workers' => $workers,
            'coffees' => $coffees,
            'teas' => $teas,
            'infusions' => $infusions
        ]);
    }
}

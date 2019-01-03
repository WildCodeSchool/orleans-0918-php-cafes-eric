<?php

namespace App\Controller;

use App\Entity\Advertise;
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
        $advertises = $this->getDoctrine()
            ->getRepository(Advertise::class)
            ->findAll();

        return $this->render('home/index.html.twig', [
            'workers' => $workers,
            'advertises' => $advertises,
        ]);
    }
}

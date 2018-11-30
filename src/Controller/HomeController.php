<?php

namespace App\Controller;

use App\Entity\Worker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
//    /**
//     * @Route("/", name="home")
//     */
//    public function index()
//    {
//        return $this->render('home/index.html.twig');
//    }

    /**
     * @Route("/", name="worker")
     */
    public function worker()
    {
        $workers = $this->getDoctrine()
            ->getRepository(Worker::class)
            ->findAll();
        return $this->render('home/index.html.twig', [
            'workers' => $workers,
        ]);
    }
}

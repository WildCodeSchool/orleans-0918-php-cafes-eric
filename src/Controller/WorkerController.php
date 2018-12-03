<?php

namespace App\Controller;

use App\Entity\Worker;
use App\Form\WorkerType;
use App\Repository\WorkerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/worker")
 */
class WorkerController extends AbstractController
{
    /**
     * @Route("/", name="worker_index", methods="GET")
     */
    public function index(WorkerRepository $workerRepository): Response
    {
        return $this->render('worker/index.html.twig', ['workers' => $workerRepository->findAll()]);
    }

    /**
     * @Route("/new", name="worker_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $worker = new Worker();
        $form = $this->createForm(WorkerType::class, $worker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($worker);
            $em->flush();

            return $this->redirectToRoute('worker_index');
        }

        return $this->render('worker/new.html.twig', [
            'worker' => $worker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="worker_show", methods="GET")
     */
    public function show(Worker $worker): Response
    {
        return $this->render('worker/show.html.twig', ['worker' => $worker]);
    }

    /**
     * @Route("/{id}/edit", name="worker_edit", methods="GET|POST")
     */
    public function edit(Request $request, Worker $worker): Response
    {
        $form = $this->createForm(WorkerType::class, $worker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('worker_index', ['id' => $worker->getId()]);
        }

        return $this->render('worker/edit.html.twig', [
            'worker' => $worker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="worker_delete", methods="DELETE")
     */
    public function delete(Request $request, Worker $worker): Response
    {
        if ($this->isCsrfTokenValid('delete'.$worker->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($worker);
            $em->flush();
        }

        return $this->redirectToRoute('worker_index');
    }
}

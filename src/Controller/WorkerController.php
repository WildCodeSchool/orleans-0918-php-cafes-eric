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
        return $this->render('admin/worker/index.html.twig', ['workers' => $workerRepository->findBy([], ['name'=>'ASC'])]);
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
            $worker->setUpdatedAt();
            $em->persist($worker);
            $em->flush();
            $this->addFlash('success', 'Le membre du personnel a bien été créé');


            return $this->redirectToRoute('worker_index');
        }

        return $this->render('admin/worker/new.html.twig', [
            'worker' => $worker,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="worker_show", methods="GET")
     */
    public function show(Worker $worker): Response
    {
        return $this->render('admin/worker/show.html.twig', ['worker' => $worker]);
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
            $this->addFlash('success', 'Le membre du personnel a bien été édité');


            return $this->redirectToRoute('worker_index', ['id' => $worker->getId()]);
        }

        return $this->render('admin/worker/edit.html.twig', [
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
            $this->addFlash('success', 'Le membre du personnel a bien été supprimé');
        }

        return $this->redirectToRoute('worker_index');
    }
}

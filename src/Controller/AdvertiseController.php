<?php

namespace App\Controller;

use App\Entity\Advertise;
use App\Form\AdvertiseType;
use App\Repository\AdvertiseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/advertise")
 */
class AdvertiseController extends AbstractController
{
    /**
     * @Route("/", name="advertise_index", methods="GET")
     */
    public function index(AdvertiseRepository $advertiseRepository): Response
    {
        return $this->render('admin/advertise/index.html.twig', ['advertises' => $advertiseRepository->findAll()]);
    }

    /**
     * @Route("/new", name="advertise_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $advertise = new Advertise();
        $form = $this->createForm(AdvertiseType::class, $advertise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advertise);
            $em->flush();

            return $this->redirectToRoute('advertise_index');
        }

        return $this->render('admin/advertise/new.html.twig', [
            'advertise' => $advertise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="advertise_edit", methods="GET|POST")
     */
    public function edit(Request $request, Advertise $advertise): Response
    {
        $form = $this->createForm(AdvertiseType::class, $advertise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('advertise_index', ['id' => $advertise->getId()]);
        }

        return $this->render('admin/advertise/edit.html.twig', [
            'advertise' => $advertise,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="advertise_delete", methods="DELETE")
     */
    public function delete(Request $request, Advertise $advertise): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advertise->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advertise);
            $em->flush();
        }

        return $this->redirectToRoute('advertise_index');
    }
}

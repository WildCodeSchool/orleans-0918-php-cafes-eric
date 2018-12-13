<?php

namespace App\Controller;

use App\Entity\Tea;
use App\Form\TeaType;
use App\Repository\TeaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/tea")
 */
class TeaController extends AbstractController
{
    /**
     * @Route("/", name="tea_index", methods="GET")
     */
    public function index(TeaRepository $teaRepository): Response
    {
        return $this->render('admin/tea/index.html.twig', ['teas' => $teaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="tea_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $tea = new Tea();
        $form = $this->createForm(TeaType::class, $tea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tea);
            $em->flush();
            $this->addFlash('success', 'Le thé a bien été ajouté à la liste');

            return $this->redirectToRoute('tea_index');
        }

        return $this->render('admin/tea/new.html.twig', [
            'tea' => $tea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tea_show", methods="GET")
     */
    public function show(Tea $tea): Response
    {
        return $this->render('admin/tea/show.html.twig', ['tea' => $tea]);
    }

    /**
     * @Route("/{id}/edit", name="tea_edit", methods="GET|POST")
     */
    public function edit(Request $request, Tea $tea): Response
    {
        $form = $this->createForm(TeaType::class, $tea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Le thé a bien été édité');

            return $this->redirectToRoute('tea_index', ['id' => $tea->getId()]);
        }

        return $this->render('admin/tea/edit.html.twig', [
            'tea' => $tea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tea_delete", methods="DELETE")
     */
    public function delete(Request $request, Tea $tea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tea->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tea);
            $em->flush();
        }

        return $this->redirectToRoute('tea_index');
    }
}

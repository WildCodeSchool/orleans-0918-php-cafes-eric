<?php

namespace App\Controller;

use App\Entity\Tea;
use App\Form\TeaType;
use App\Repository\TeaRepository;
use App\Service\MaxProductChecker;
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
     * @Route("/{id}/novelty", name="tea_novelty", methods="GET|POST"))
     */
    public function updateNovelty(Tea $tea, MaxProductChecker $maxProductChecker): Response
    {
        if ($maxProductChecker->checkNoveltyNumber() || $tea->getNovelty()) {
            $tea->setNovelty(!$tea->getNovelty());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Modification enregistrée');
        } else {
            $this->addFlash('danger', 'Impossible d\'ajouter plus de ' . MaxProductChecker::MAX . ' nouveautés');
        }


        return $this->redirectToRoute('tea_index');
    }

    /**
     * @Route("/{id}/highlighted", name="tea_highlighted", methods="GET|POST"))
     */
    public function updateHighlighted(Tea $tea, MaxProductChecker $maxProductChecker): Response
    {
        if ($maxProductChecker->checkHighlightedNumber() || $tea->getHighlighted()) {
            $tea->setHighlighted(!$tea->getHighlighted());
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'Modification enregistrée');
        } else {
            $this->addFlash('danger', 'Impossible d\'ajouter plus de ' . MaxProductChecker::MAX . ' produits du mois');
        }


        return $this->redirectToRoute('tea_index');
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
            $this->addFlash('success', 'Le thé a bien été supprimé');
        }

        return $this->redirectToRoute('tea_index');
    }
}

<?php

namespace App\Controller;

use App\Entity\Grocery;
use App\Form\GroceryType;
use App\Repository\GroceryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/grocery")
 */
class GroceryController extends AbstractController
{
    /**
     * @Route("/", name="grocery_index", methods="GET")
     */
    public function index(GroceryRepository $groceryRepository): Response
    {
        return $this->render('admin/grocery/index.html.twig', ['groceries' => $groceryRepository->findAll()]);
    }

    /**
     * @Route("/new", name="grocery_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $grocery = new Grocery();
        $form = $this->createForm(GroceryType::class, $grocery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grocery);
            $em->flush();
            $this->addFlash('success', 'L\' épice à bien été ajouter à la liste ');


            return $this->redirectToRoute('grocery_index');
        }

        return $this->render('admin/grocery/new.html.twig', [
            'grocery' => $grocery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="grocery_show", methods="GET")
     */
    public function show(Grocery $grocery): Response
    {
        return $this->render('admin/grocery/show.html.twig', ['grocery' => $grocery]);
    }

    /**
     * @Route("/{id}/edit", name="grocery_edit", methods="GET|POST")
     */
    public function edit(Request $request, Grocery $grocery): Response
    {
        $form = $this->createForm(GroceryType::class, $grocery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', 'L\' épice à bien été édité');


            return $this->redirectToRoute('grocery_index', ['id' => $grocery->getId()]);
        }

        return $this->render('admin/grocery/edit.html.twig', [
            'grocery' => $grocery,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="grocery_delete", methods="DELETE")
     */
    public function delete(Request $request, Grocery $grocery): Response
    {
        if ($this->isCsrfTokenValid('delete'.$grocery->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grocery);
            $em->flush();
            $this->addFlash('success', 'L\' épice à bien été supprimé');
        }

        return $this->redirectToRoute('grocery_index');
    }
}

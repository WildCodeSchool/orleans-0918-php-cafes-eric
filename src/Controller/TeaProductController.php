<?php

namespace App\Controller;

use App\Entity\TeaProduct;
use App\Form\TeaProductType;
use App\Repository\TeaProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/tea/product")
 */
class TeaProductController extends AbstractController
{
    /**
     * @Route("/", name="tea_product_index", methods="GET")
     */
    public function index(TeaProductRepository $teaProductRepository): Response
    {
        return $this->render('tea_product/index.html.twig', ['tea_products' => $teaProductRepository->findAll()]);
    }

    /**
     * @Route("/new", name="tea_product_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $teaProduct = new TeaProduct();
        $form = $this->createForm(TeaProductType::class, $teaProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($teaProduct);
            $em->flush();

            return $this->redirectToRoute('tea_product_index');
        }

        return $this->render('tea_product/new.html.twig', [
            'tea_product' => $teaProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tea_product_show", methods="GET")
     */
    public function show(TeaProduct $teaProduct): Response
    {
        return $this->render('tea_product/show.html.twig', ['tea_product' => $teaProduct]);
    }

    /**
     * @Route("/{id}/edit", name="tea_product_edit", methods="GET|POST")
     */
    public function edit(Request $request, TeaProduct $teaProduct): Response
    {
        $form = $this->createForm(TeaProductType::class, $teaProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tea_product_index', ['id' => $teaProduct->getId()]);
        }

        return $this->render('tea_product/edit.html.twig', [
            'tea_product' => $teaProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tea_product_delete", methods="DELETE")
     */
    public function delete(Request $request, TeaProduct $teaProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$teaProduct->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($teaProduct);
            $em->flush();
        }

        return $this->redirectToRoute('tea_product_index');
    }
}

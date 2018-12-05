<?php

namespace App\Controller;

use App\Entity\InfusionProduct;
use App\Form\InfusionProductType;
use App\Repository\InfusionProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/infusion/product")
 */
class InfusionProductController extends AbstractController
{
    /**
     * @Route("/", name="infusion_product_index", methods="GET")
     */
    public function index(InfusionProductRepository $infusionProductRepository): Response
    {
        return $this->render('infusion_product/index.html.twig',
            ['infusion_products' => $infusionProductRepository->findAll()]);
    }

    /**
     * @Route("/new", name="infusion_product_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $infusionProduct = new InfusionProduct();
        $form = $this->createForm(InfusionProductType::class, $infusionProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infusionProduct);
            $em->flush();

            return $this->redirectToRoute('infusion_product_index');
        }

        return $this->render('infusion_product/new.html.twig', [
            'infusion_product' => $infusionProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="infusion_product_show", methods="GET")
     */
    public function show(InfusionProduct $infusionProduct): Response
    {
        return $this->render('infusion_product/show.html.twig', ['infusion_product' => $infusionProduct]);
    }

    /**
     * @Route("/{id}/edit", name="infusion_product_edit", methods="GET|POST")
     */
    public function edit(Request $request, InfusionProduct $infusionProduct): Response
    {
        $form = $this->createForm(InfusionProductType::class, $infusionProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('infusion_product_index', ['id' => $infusionProduct->getId()]);
        }

        return $this->render('infusion_product/edit.html.twig', [
            'infusion_product' => $infusionProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="infusion_product_delete", methods="DELETE")
     */
    public function delete(Request $request, InfusionProduct $infusionProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infusionProduct->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($infusionProduct);
            $em->flush();
        }

        return $this->redirectToRoute('infusion_product_index');
    }
}

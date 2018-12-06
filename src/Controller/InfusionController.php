<?php

namespace App\Controller;

use App\Entity\Infusion;
use App\Form\InfusionType;
use App\Repository\InfusionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/infusion/product")
 */
class InfusionController extends AbstractController
{
    /**
     * @Route("/", name="infusion_product_index", methods="GET")
     */
    public function index(InfusionRepository $infusionProductRepository): Response
    {
        return $this->render('admin/infusion_product/index.html.twig', [
            'infusion_products' => $infusionProductRepository->findAll()
        ]);
    }

    /**
     * @Route("/new", name="infusion_product_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $infusionProduct = new Infusion();
        $form = $this->createForm(InfusionType::class, $infusionProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($infusionProduct);
            $em->flush();
            $this->addFlash('success', 'L\'infusion a bien été ajouté à la liste');

            return $this->redirectToRoute('infusion_product_index');
        }

        return $this->render('admin/infusion_product/new.html.twig', [
            'infusion_product' => $infusionProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="infusion_product_show", methods="GET")
     */
    public function show(Infusion $infusionProduct): Response
    {
        return $this->render('admin/infusion_product/show.html.twig', ['infusion_product' => $infusionProduct]);
    }

    /**
     * @Route("/{id}/edit", name="infusion_product_edit", methods="GET|POST")
     */
    public function edit(Request $request, Infusion $infusionProduct): Response
    {
        $form = $this->createForm(InfusionType::class, $infusionProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('infusion_product_index', ['id' => $infusionProduct->getId()]);
        }

        return $this->render('admin/infusion_product/edit.html.twig', [
            'infusion_product' => $infusionProduct,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="infusion_product_delete", methods="DELETE")
     */
    public function delete(Request $request, Infusion $infusionProduct): Response
    {
        if ($this->isCsrfTokenValid('delete'.$infusionProduct->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($infusionProduct);
            $em->flush();
        }

        return $this->redirectToRoute('infusion_product_index');
    }
}

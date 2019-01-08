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
     * @Route("/edit", name="advertise_edit", methods="GET|POST")
     * @param Request $request
     * @param AdvertiseRepository $advertiseRepository
     * @return Response
     */
    public function edit(Request $request, AdvertiseRepository $advertiseRepository): Response
    {
        $advertise = $advertiseRepository->findOneBy([]) ?? (new Advertise())->setContent('');
        $form = $this->createForm(AdvertiseType::class, $advertise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advertise);
            $em->flush();

            return $this->redirectToRoute('advertise_edit');
        }

        return $this->render('admin/advertise/edit.html.twig', [
            'advertise' => $advertise,
            'form' => $form->createView(),
        ]);
    }
}

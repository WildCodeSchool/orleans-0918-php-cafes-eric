<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new \Swift_Message('Vous avez recu un mail'))
                ->setFrom($contactFormData->getEmail())
                ->setTo($this->getParameter('mail_from'))
                ->setReplyTo($contactFormData->getEmail())
                ->setBody(
                    'Message venant de :  ' .
                        ucwords($contactFormData->getName()) .' ' .
                        ucwords($contactFormData->getFirstname()) . ' : ' .
                        'joingnable au téléphone : ' .
                        ($contactFormData->getPhone()) .
                        ' message :'.
                    $contactFormData->getMessage(),
                    'text/plain'
                );

             $mailer->send($message);

            $this->addFlash(
                'success',
                'Votre mail a été envoyé!'
            );
            return $this->redirectToRoute('contact');
        }
        return $this->render(
            '/contact/index.html.twig',
            [
            'form' => $form->createView()
            ]
        );
    }
}

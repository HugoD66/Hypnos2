<?php

namespace App\Controller;

use App\Entity\ContactUs;
use App\Form\ContactUsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormTypeInterface;

class ContactUsController extends AbstractController
{
    #[Route('/contactus', name: 'app_contactus')]
    public function new(Request $request): Response
    {

        $contactus = new ContactUs();

        $form = $this->createForm(ContactUsType::class, $contactus);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $contactus = $form->getData();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_home');
        }
        return $this->renderForm('form/contactus.html.twig', [
            'form' => $form
        ]);
    }
}

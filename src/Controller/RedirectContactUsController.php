<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectContactUsController extends AbstractController
{
    #[Route('/redirect/contactus', name: 'app_redirect_contact_us')]
    public function index(): Response
    {
        return $this->render('form/redirectcontactus.html.twig', [
            'title' => 'Hypnos- Redirection ContactUs',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RedirectregisterController extends AbstractController
{
    #[Route('/redirectregister', name: 'app_redirectifregister')]
    public function index(): Response
    {
        return $this->render('registration/redirectifregister.html.twig');
    }
}

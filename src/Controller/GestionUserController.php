<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionUserController extends AbstractController
{
    #[Route('/gestion/user', name: 'app_gestion_user')]
    public function index(): Response
    {
        return $this->render('gestion/user.html.twig', [
            'title' => 'Hypnos- Gestion Utilisateur.',
        ]);
    }
}

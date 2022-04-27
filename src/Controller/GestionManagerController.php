<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionManagerController extends AbstractController
{
    #[Route('/gestion/manager', name: 'app_gestion_manager')]
    public function index(): Response
    {
        return $this->render('gestion/manager.html.twig', [
            'controller_name' => 'GestionManagerController',
        ]);
    }
}

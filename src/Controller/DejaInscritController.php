<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DejaInscritController extends AbstractController
{
    #[Route('/dejainscrit', name: 'app_deja_inscrit')]
    public function index(): Response
    {


        $user = $this->getUser();



        return $this->render('security/dejainscrit.html.twig', [
            'title' => 'Hypnos- Vous êtes déja inscrit.',
            'user' => $user,
        ]);
    }
}

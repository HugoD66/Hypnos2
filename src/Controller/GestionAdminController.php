<?php

namespace App\Controller;

use App\Entity\ContactUs;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionAdminController extends AbstractController
{
    #[Route('/gestion/admin', name: 'app_gestion_admin')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();

        $contact = $doctrine->getRepository(ContactUs::class)->getContactUsList();
        $em = $doctrine->getRepository(User::class)->getListManager();
        return $this->render('gestion/admin.html.twig', [
            'title' => 'Hypnos- Gestion Administrateur.',
            'user' => $user,
            'usermanager' => $em,
            'contactuslist' => $contact
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\ContactUs;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionAdminController extends AbstractController
{
    #[Route('/gestion/admin', name: 'app_gestion_admin')]
    public function index(ManagerRegistry $doctrine, EntityManagerInterface $entityManager): Response
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

    #[Route('/gestion/admin/delete/{id}', name: 'delete_form')]
    public function remove(ManagerRegistry $doctrine, EntityManagerInterface $entityManager, int $id): Response
    {
        $delete = $doctrine->getRepository($this->$id)->find($id);

        $entityManager->remove((object)$id);
        $entityManager->flush();

        return $this->render('gestion/admin.html.twig', [
            'remove' => $delete,
            ]);

    }
}

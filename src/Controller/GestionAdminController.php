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

    #[Route('/gestion/admin/remove/contactus/{id}', name: 'delete_form')]
    public function remove(ManagerRegistry $doctrine,  $id): Response
    {
        $entityManager = $doctrine->getManager();
        $contact = $entityManager->getRepository(ContactUs::class)->findOneBy(['id' => $id]);
        $entityManager->remove($contact);
        $entityManager->flush();

        return $this->redirectToRoute('app_gestion_admin', [
        ]);
    }

    #[Route('/gestion/admin/remove/manager/{id}', name: 'manager_delete')]
    public function delete(ManagerRegistry $doctrine,  $id): Response
    {
        $entityManager = $doctrine->getManager();
        $manager = $entityManager->getRepository(User::class)->findOneBy(['id' => $id]);
        $entityManager->remove($manager);
        $entityManager->flush();


        return $this->redirectToRoute('app_gestion_admin', [
            'usermanager' => $manager,

        ]);
    }

}

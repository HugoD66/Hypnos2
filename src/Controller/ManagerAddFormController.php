<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ManagerAddFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class ManagerAddFormController extends AbstractController
{
    #[Route('/manager/add/form', name: 'app_manager_add_form')]
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher,  EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(ManagerAddFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(array('ROLE_MANAGER'));
            $user->setIsVerified(1);

            $entityManager->persist($user);
            $entityManager->flush();
        }
        
        return $this->render('gestion/manageradd.html.twig', [
            'title' => 'Hypnos- Ajouter un Manager',
            'form' => $form->createView(),

        ]);
    }
}

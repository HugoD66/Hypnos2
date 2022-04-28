<?php

namespace App\Controller;

use App\Entity;
use App\Form\PictureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class GestionManagerController extends AbstractController
{
    #[Route('/gestion/manager', name: 'app_gestion_manager')]
    public function index(EntityManagerInterface $entityManager, Request $request, SluggerInterface $slugger): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(PictureType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $picturefile = $form->get('picture')->getData();
            if ($picturefile) {
                $originalFilename = pathinfo($picturefile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $picturefile->guessExtension();
                try {
                    $picturefile->move(
                        $this->getParameter('picture-gestion'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $entityManager->persist((object)$newFilename);

                $entityManager->flush();


            }

            return $this->redirectToRoute('app_gestion_manager');
        }

        return $this->render('gestion/manager.html.twig', [
            'title' => 'Hypnos- Gestion Manager.',
            'user' => $user,
            'form' => $form->createView(),

        ]);
    }


}

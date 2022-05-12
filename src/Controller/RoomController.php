<?php

namespace App\Controller;

use App\Entity\Room;
use App\Form\RoomType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RoomController extends AbstractController
{
    #[Route('/room', name: 'app_room')]
    public function new(EntityManagerInterface $entityManager,Request $request, SluggerInterface $slugger): Response
    {
        $room = new Room();
        $form = $this->createForm(RoomType::class, $room);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form->get('picture')->getData();
            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();
                try {
                    $pictureFile->move(
                        $this->getParameter('picture-gestion'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $room->setPicture($newFilename);
                $entityManager->persist($room);
                $entityManager->flush();
            }
            return $this->redirectToRoute('app_home');
        }
        return $this->render('form/room.html.twig', [
            'title' => 'Hypnos- Ajout d\'une chambre',
            'form' => $form->createView(),
        ]);
    }
}

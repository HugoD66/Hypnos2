<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{
    #[Route('/hotel/{user}', name: 'app_hotel')]
    public function update(ManagerRegistry $doctrine, int $id): Response
    {

        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(User::class)->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $product->setGotHotel('1');
        $entityManager->flush();


        return $this->render('hotel/hotel.html.twig', [
            'controller_name' => 'HotelController',
            'id' => $product->getId()

        ]);
    }
}

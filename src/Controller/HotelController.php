<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\Room;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HotelController extends AbstractController
{
    #[Route('/hotel/{id}', name: 'app_hotel')]
    public function update(ManagerRegistry $doctrine, int $id): Response
    {
        $hotel = $doctrine->getRepository(Hotel::class)->find($id);

        $room = $doctrine->getRepository(Room::class)->findAll();

        return $this->render('hotel/hotel.html.twig', [
            'title' => 'Hypnos- Votre Hotel.',
            'id' => $hotel,
            'room' => $room,
        ]);
    }
}

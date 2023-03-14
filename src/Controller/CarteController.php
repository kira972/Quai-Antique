<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(
        OpeningTimeRepository $openingTimeRepository,
        RestaurantRepository $restaurantRepository
    ): Response
    {
        $openingTimes = $openingTimeRepository->findAll();
        $restaurant = $restaurantRepository->findOneBy(['name' => 'Quai Antique']);
        return $this->render('pages/carte/index.html.twig', [
            'openingTimes' => $openingTimes,
            'restaurant' => $restaurant,
        ]);
    }
}

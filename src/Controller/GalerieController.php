<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GalerieController extends AbstractController
{
    #[Route('/galerie', name: 'app_galerie')]
    public function index(
        OpeningTimeRepository $openingTimeRepository, 
        RestaurantRepository $restaurantRepository
        ): Response
    {
        $openingTimes = $openingTimeRepository->findAll();
        $restaurant = $restaurantRepository->findOneBy(['name' => 'Quai Antique']);

        return $this->render('pages/galerie/index.html.twig', [

            'openingTimes' => $openingTimes,
            'restaurant' => $restaurant,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\RestaurantRepository;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarteController extends AbstractController
{
    #[Route('/carte', name: 'app_carte')]
    public function index(
        OpeningTimeRepository $openingTimeRepository,
        RestaurantRepository $restaurantRepository,
        CategoryRepository $categoryRepository,
    ): Response
    {
        $openingTimes = $openingTimeRepository->findAll();
        $restaurant = $restaurantRepository->findOneBy(['name' => 'Quai Antique']);
        $categories = $categoryRepository->findAll();
        return $this->render('pages/carte/index.html.twig', [
            'openingTimes' => $openingTimes,
            'restaurant' => $restaurant,
            'categories' => $categories,
        ]);
    }
}

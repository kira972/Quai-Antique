<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use App\Repository\RestaurantRepository;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(
        OpeningTimeRepository $openingTimeRepository,
        RestaurantRepository $restaurantRepository,
        MenuRepository $menuRepository,
    ): Response

    {
        $openingTimes = $openingTimeRepository->findAll();
        $restaurant = $restaurantRepository->findOneBy(['name' => 'Quai Antique']);
        $menus = $menuRepository->findAll();
        return $this->render('pages/menu/index.html.twig', [
            'openingTimes' => $openingTimes,
            'restaurant' => $restaurant,
            'menus' => $menus,
        ]);
        
    }
}

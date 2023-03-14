<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use App\Repository\OpeningTimeRepository;
use App\Repository\PictureRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        OpeningTimeRepository $openingTimeRepository,
        RestaurantRepository $restaurantRepository,
        PictureRepository $pictureRepository
        ): Response
    {
        $openingTimes = $openingTimeRepository->findAll();
        $restaurant = $restaurantRepository->findOneBy(['name' => 'Quai Antique']);
        $picturesIsFavorite = $pictureRepository->findBy(['isFavorite'=> true], ['name' => 'ASC'], 8);

        dd($picturesIsFavorite);

        return $this->render('pages/home/index.html.twig', [
            'openingTimes' => $openingTimes,
            'restaurant' => $restaurant,
            'picturesIsFavorite' => $picturesIsFavorite
        ]);
    }
}

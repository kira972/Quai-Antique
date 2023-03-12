<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(OpeningTimeRepository $openingTimeRepository): Response
    {
        $openingTimes = $openingTimeRepository->findAll();

        return $this->render('pages/home/index.html.twig', [
            'openingTimes' => $openingTimes,
        ]);
    }
}

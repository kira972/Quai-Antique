<?php

namespace App\Controller;

use id;
use App\Entity\User;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\UserRepository;
use App\Repository\AllergieRepository;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ReservationController extends AbstractController
{


    #[Route('/reservation-info/{id}', name: 'app_reservation-info', methods : ['GET', 'POST'])]
    public function getReservationInfo( UserRepository $userRepository )
    {
        //$repository = json_decode($userRepository->getContent($id), true);
        
        
        // $userRepository = $id['date'];
        // $reservationTime = $['time'];
        // $numGuests = $repositorynNumberCover['num_guests'];
        // $reservationName = $requestData['reservation_name'];
        // $allergies = $repositoryAllergie['allergies'];

        // Effectuer les traitements nécessaires

        // Retourner les données au format JSON 
        $data = [
            //'user' => $repository
        //   'date' => $reservationDate,
        //   'time' => $reservationTime,
        //   'num_guests' => $numGuests,
        //   'reservation_name' => $reservationName,
        //   'allergies' => $allergies,
        ];

        return $this->json($data);
    }


    #[Route('/reservation', name: 'app_reservation')]
    public function index( 
        Request $request,
        EntityManagerInterface $manager,      
        OpeningTimeRepository $openingTimeRepository,
        RestaurantRepository $restaurantRepository,
    ): Response
    {
        $openingTimes = $openingTimeRepository->findAll();
        $restaurant = $restaurantRepository->findOneBy(['name' => 'Quai Antique']);

        $reservation = new Reservation();
        
        $user = $this->getUser();
        /** @var User $user */
        if($user) {
            $reservation->setName($user->getLastname());
            $reservation->setNumberCover($user->getDefaultNumberCover());
            $reservation->setUser($user);
        }
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();
            
            $reservation->setRestaurant($restaurant);
            
            $allergies = $form->get('allergie')->getData();
            foreach ($allergies as $allergie) {
                $reservation->addAllergieReserv($allergie);
            }
            
            $this->addFlash(
                'success',
                'Votre reservation à bien été pris en compte.'
            );

            $manager->persist($reservation);
            $manager->flush();

            // return $this-> redirectToRoute('app_home');      
            return $this-> redirectToRoute('app_reservation-info');      
        }

        return $this->render('pages/reservation/index.html.twig', [
            'form' => $form->createView(),
            'openingTimes' => $openingTimes,
            'restaurant' => $restaurant,
        ]);
    }


    
}

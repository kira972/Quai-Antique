<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    /**
     * This controller allow us to login
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils,
    OpeningTimeRepository $openingTimeRepository,
    RestaurantRepository $restaurantRepository,
    ): Response
    {
        $openingTimes = $openingTimeRepository->findAll();
        $restaurant = $restaurantRepository->findOneBy(['name' => 'Quai Antique']);

        return $this->render('pages/security/login.html.twig', [
            'openingTimes' => $openingTimes,
            'restaurant' => $restaurant,
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/deconnexion', name: 'security.logout')]
    /**
     * This controller allow us to logout
     *
     * @return void
     */
    public function logout()
    {
        //Nothing to do here
    }

    #[Route('/inscription', name: 'security.registration', methods: ['GET', 'POST'])]
/**
 * This controller allow us to register
 *
 * @param Request $request
 * @param EntityManagerInterface $manager
 * @return Response
 */

    public function registration(
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $passwordHasher,
        OpeningTimeRepository $openingTimeRepository,
        RestaurantRepository $restaurantRepository,
        ): Response
    {
        $openingTimes = $openingTimeRepository->findAll();
        $restaurant = $restaurantRepository->findOneBy(['name' => 'Quai Antique']);

        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $allergies = $form->get('allergie')->getData();
            $plainPassword = $form->get('plainPassword')->getData();

            foreach ($allergies as $allergie) {
                $user->addAllergie($allergie);
            }

            $user->setRoles(['ROLE_MEMBER']);

            $user->setPassword($passwordHasher->hashPassword($user, $plainPassword));

            $this->addFlash(
                'success',
                'Votre compte à bien été crée.'
            );

            $manager->persist($user);
            $manager->flush();

            return $this-> redirectToRoute('security.login');      
        }

        return $this-> render('pages/security/registration.html.twig', [
            'form' => $form->createView(),
            'openingTimes' => $openingTimes,
            'restaurant' => $restaurant,
        ]);
    }
}

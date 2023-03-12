<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    /**
     * This controller allow us to login
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils ): Response
    {
        return $this->render('pages/security/login.html.twig', [
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
    public function registration(Request $request, EntityManagerInterface $manager): Response
    {

        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $this->addFlash(
                'success',
                'Votre compte à bien été crée.'
            );

            $manager->persist($user);
            $manager->flush();

            return $this-> redirectToRoute('security.login');      
        }

        return $this-> render('pages/security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

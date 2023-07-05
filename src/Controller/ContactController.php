<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        EntityManagerInterface $manager
        ): Response{

        $contact = new Contact();
        if ($this->getUser()) {
            $contact->setFirstname($this->getUser()->getFirstname())
            ->setLastName($this->getUser()->getLastName())
            ->setEmail($this->getUser()->getEmail());
        }

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isvalid()) {
            $contact = $form->getData();

            $manager->persist($contact);

            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message à bien été envoyé.'
            );
            return $this->redirectToRoute('app_home');
        }

        return $this->render('pages/contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

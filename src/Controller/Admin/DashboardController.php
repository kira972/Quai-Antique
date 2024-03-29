<?php

namespace App\Controller\Admin;



use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\Restaurant;
use App\Entity\OpeningTime;
use App\Entity\Reservation;
use App\Entity\Category;
use App\Entity\Contact;
use App\Controller\Admin\MenuCrudController;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\Admin\PictureCrudController;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use App\Controller\Admin\RestaurantCrudController;
use App\Controller\Admin\OpeningTimeCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;


class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setcontroller(OpeningTimeCrudController::class)
            ->setcontroller(ReservationTimeCrudController::class)
            ->setcontroller(UserCrudController::class)
            ->setcontroller(RestaurantCrudController::class)
            ->setcontroller(PictureCrudController::class)
            ->setController(MenuCrudController::class)
            ->setController(ProductCrudController::class)
            ->setController(CategoryCrudController::class)
            ->setController(ContactCrudController::class)




            ->generateUrl();

        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Quai Antique - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Horaire d\'ouverture', 'fa-sharp fa-solid fa-clock')->setSubItems([
            MenuItem::linkToCrud('create Horaire d\'ouverture', 'fas fa-plus', OpeningTime::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('show Horaire d\'ouverture', 'fas fa-eye', OpeningTime::class)
        ]);

        yield MenuItem::subMenu('Réservation', 'fa-solid fa-book')->setSubItems([
            MenuItem::linkToCrud('create Réservation', 'fas fa-plus', Reservation::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('show Réservations', 'fas fa-eye', Reservation::class),
        ]);

        yield MenuItem::subMenu('Utilisateurs', 'fa-solid fa-users')->setSubItems([
            MenuItem::linkToCrud('create Utilisateur', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('show Utilisateurs', 'fas fa-eye', User::class),
        ]);

        yield MenuItem::subMenu('Coordonnées', 'fa-solid fa-phone')->setSubItems([
            MenuItem::linkToCrud('create Coordonnées', 'fas fa-plus', Restaurant::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('show Coordonnées', 'fas fa-eye', Restaurant::class),
        ]);

        yield MenuItem::subMenu('Photos plats', 'fa-solid fa-image')->setSubItems([
            MenuItem::linkToCrud('create Image', 'fas fa-plus', Picture::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('show Images', 'fas fa-eye', Picture::class),
        ]);

        yield MenuItem::subMenu('Menu', 'fa-solid fa-pen-to-square')->setSubItems([
            MenuItem::linkToCrud('create Menu', 'fas fa-plus', Menu::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('show Menu', 'fas fa-eye', Menu::class),
        ]);

        yield MenuItem::subMenu('Product', 'fa-solid fa-pen-to-square')->setSubItems([
            MenuItem::linkToCrud('create Product', 'fas fa-plus', Product::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('show Product', 'fas fa-eye', Product::class),
        ]);

        yield MenuItem::subMenu('Category', 'fa-solid fa-pen-to-square')->setSubItems([
            MenuItem::linkToCrud('create Category', 'fas fa-plus', Category::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('show Category', 'fas fa-eye', Category::class),
        ]);
        yield MenuItem::subMenu('Email', 'fa-solid fa-pen-to-square')->setSubItems([
            MenuItem::linkToCrud('show Email', 'fas fa-eye', Contact::class),
        ]);
    }
}

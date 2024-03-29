<?php

namespace App\DataFixtures;

use Datetime;
use Faker\Factory;
use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\Allergie;
use App\Entity\Category;
use App\Entity\Restaurant;
use App\Entity\OpeningTime;
use App\Entity\Reservation;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
        $passwordHasher = $this->passwordHasher;
    }

    //User
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 16; $i++) {
            $user = new User();
            $user->setFirstName($faker->firstname())
                ->setLastName($faker->lastname())
                ->setEmail($faker->unique()->email())
                ->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            if ($i < 2) {
                $user->setRoles(['ROLE_ADMIN'])
                    ->setDefaultNumberCover(1);
            } else {
                $user->setRoles(['ROLE_MEMBER'])
                    ->setDefaultNumberCover(mt_rand(1, 10));
            }

            if ($i > 1) {
                $membres[] = $user;
            }

            $manager->persist($user);
        }

        //Allergie
        $allergiesName = ['Oeuf', 'Lait', 'Gluten', 'Moutarde', 'Arachide', 'Poissons', 'Soja', 'Sulfites', 'Fruits à coque', 'Céleri'];
        for ($j = 0; $j < 10; $j++) {
            $allergie = new Allergie();
            $allergie->setDescription($allergiesName[$j])
                ->addUser($faker->unique()->randomElement($membres));
            $allergies[] = $allergie;
            $manager->persist($allergie);
        }

        //Restaurant
        $restaurant = new Restaurant();
        $restaurant->setName('Quai Antique')
            ->setPhoneNumber('0596523023')
            ->setMail('QuaiAntique@resto.fr')
            ->setAddress('27, rue du Paradis')
            ->setPostcode('44000')
            ->setCity('Nantes');

        $manager->persist($restaurant);

        //Reservation
        for ($k = 0; $k < 16; $k++) {

            $date = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 month', '-1 week'));
            $hours = ['1200', '1230', '1300', '1330', '1400', '1900', '1930', '2000', '2030', '2100', '2130'];

            $reservation = new Reservation();
            $reservation->setUser($faker->unique()->randomElement($membres))
                ->setRestaurant($restaurant)
                ->setDate($date)
                ->setHour(new Datetime($faker->randomElement($hours)))
                ->setNumberCover(mt_rand(1, 10))
                ->setName($faker->word());

            for ($s = 0; $s < mt_rand(0, 2); $s++) {
                $reservation->addAllergieReserv($faker->unique()->randomElement($allergies));
            }

            $manager->persist($reservation);
        }

        //OpeningTime
        $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
        $times = ['12:00', '14:00', '19:00', '22:00'];
        $date->format('Y-m-d');
        for ($l = 0; $l < count($days); $l++) {
            $openingTime = new OpeningTime();
            $time1 = new \DateTime($times[0]);
            $time2 = new \DateTime($times[1]);
            $time3 = new \DateTime($times[2]);
            $time4 = new \DateTime($times[3]);

            $day = $days[$l];

            $openingTime->setlunchOpen($time1)
                ->setLunchClose($time2)
                ->setDinnerOpen($time3)
                ->setDinnerClose($time4)
                ->setdayOfWeek($day)
                ->setRestaurant($restaurant);

            $manager->persist($openingTime);
        }

        //Picture
        $pictureMenuList = [];
        $pictureProductList = [];
        $pictureCategoryList = [];
        $pictsFilename = ['fajitas.webp', 'assortiment.webp', 'buffet-fiesta.webp', 'burritos.webp', 'churros.webp', 'carlota.webp', 'ceviche.webp', 'cheesecake-caramel.webp', 'chilaquiles-rojos.webp', 'chilaquiles.webp', 'chilicon.webp', 'chololat-epice.webp', 'churros.webp', 'crevette.webp', 'empanadas.webp', 'enchilada.webp', 'entrees.webp', 'chilaquiles-rojos.webp', 'chilicon.webp', 'figue.webp', 'mexicain-avocat.webp', 'mexican.webp', 'plat-mexicain.webp', 'viandes.webp', 'poisson.webp', 'poisson1.webp', 'poisson2.webp', 'poisson3.webp', 'poisson4.webp', 'pozole.webp', 'pudding.webp', 'quesadillaS.webp', 'quesadilla-2.webp', 'tacos-beef.webp', 'tacos-saumon.webp', 'tacos.webp', 'tostadas.webp', 'horchata.webp', 'menu1.webp', 'menu2.webp', 'menu3.webp'];
        $pictsName = ['fajitas', 'assortiment', 'buffet-fiesta', 'burritos', 'churros', 'carlota', 'ceviche', 'cheesecake-caramel', 'chilaquiles-rojos', 'chilaquiles', 'chilicon', 'chololat-epice', 'churros', 'crevette', 'empanadas', 'enchilada', 'entrees', 'chilaquiles-rojos', 'chilicon', 'figue', 'mexicain-avocat', 'mexican', 'plat-mexicain', 'viandes', 'poisson', 'poisson1', 'poisson2', 'poisson3', 'poisson4', 'pozole', 'pudding', 'quesadillaS', 'quesadilla-2', 'tacos-beef', 'tacos-saumon', 'tacos', 'tostadas', 'horchata', 'menu1', 'menu2', 'menu3'];
        for ($q = 0; $q < count($pictsFilename); $q++) {
            $picture = new Picture();
            $picture->setName($pictsName[$q])
                ->setDescription($faker->text(300))
                ->setFilename($pictsFilename[$q])
                ->setIsFavorite($faker->boolean())
                ->setIsShowingInGallery($faker->boolean());

            if ($q >= (count($pictsFilename) - 3)) {
                $pictureMenuList[] = $picture;
            } else {
                $pictureProductList[] = $picture;
            }
            if (in_array($pictsName[$q], ['entrees', 'viandes', 'poisson', 'horchata'])) {
                $pictureCategoryList[] = $picture;
            }
            $manager->persist($picture);
        }

        //Category
        $categoriesName = ['Entrées', 'Viandes', 'Poissons', 'Desserts'];
        $categories = [];
        for ($o = 0; $o < 4; $o++) {
            $category = new Category();
            $category->setName($categoriesName[$o])
                ->setPicture($pictureCategoryList[$o]);
            $categories[] = $category;

            $manager->persist($category);
        }

        //Product
        $products = [];
        for ($p = 0; $p <= 37; $p++) {
            $product = new Product();
            $product->setName($faker->word())
                ->setPrice($faker->randomFloat(1, 18, 36))
                ->setDescription($faker->text(100))
                ->setCategory($faker->randomElement($categories))
                ->setPicture($pictureProductList[$p]);
            $products[] = $product;

            $manager->persist($product);
        }

        //Menu
        $menusName = ['Menu du midi', 'Menu du soir', 'Menu Enfant'];
        for ($m = 0; $m < 3; $m++) {
            $menu = new Menu();
            $menu->setName($menusName[$m])
                ->setDescription($faker->text(100))
                ->setPrice($faker->randomFloat(1, 15, 35))
                ->setPicture($pictureMenuList[$m]);

            $manager->persist($menu);
        }

        //Contact
        for ($z=0; $z < 5; $z++) { 
            $contact=new Contact();
            $contact->setfirstname($faker->firstname())
            ->setLastName($faker->lastname())
            ->setEmail($faker->unique()->email())
            ->setsubject('Demande numéro' . ($i + 1))
            ->setMessage($faker->text());

            $manager->persist($contact);

        }

        $manager->flush();
    }
}

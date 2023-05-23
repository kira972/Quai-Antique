<?php

namespace App\DataFixtures;

use Datetime;
use Faker\Factory;
use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Formule;
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
                $user->setRoles(['ROLE_ADMIN']);
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

            for ($s = 0; $s < mt_rand(0, 3); $s++) {
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

        //Menu
        $menu = new Menu();
        $menu->setName($faker->word())
            ->setDescription($faker->text(100));

        $manager->persist($menu);

        //Formule
        for ($n = 0; $n < 3; $n++) {
            $formule = new Formule();
            $formule->setDescription($faker->text(100))
                ->setName($faker->word())
                ->setPrice($faker->randomFloat(1, 20, 30))
                ->setMenu($menu);

            $manager->persist($formule);
        }

        //Category
        for ($o = 0; $o < 6; $o++) {
            $category = new Category();
            $category->setName($faker->word());
            $categories[] = $category;

            $manager->persist($category);
        }

        //Product
        for ($p = 0; $p < 38; $p++) {
            $product = new Product();
            $product->setName($faker->word())
                ->setPrice($faker->randomFloat(1, 18, 36))
                ->setCategory($faker->randomElement($categories));
            $products[] = $product;

            $manager->persist($product);
        }

        //Picture
        $pictsFilename = ['fajitas.png', 'assortiment.jpg', 'buffet-fiesta.jpg', 'burritos.jpg', 'carlota.jpg', 'ceviche.jpg', 'cheesecake-caramel.png', 'chilaquiles-rojos.png', 'chilaquiles.jpg', 'chilicon.jpg', 'chololat-epice.jpg', 'churros.jpg', 'crevette.jpg', 'empanadas.jpeg', 'enchilada.jpg', 'entrees.jpg', 'horchata.jpg', 'crevette.jpg', 'chilaquiles-rojos.png', 'chilicon.jpg', 'figue.jpg', 'mexicain-avocat.jpg', 'mexican.jpg', 'plat-mexicain.jpg', 'poisson.jpg', 'poisson1.jpeg', 'poisson2.jpg', 'poisson3.jpg', 'poisson4.jpg', 'pozole.jpg', 'pudding.jpg', 'quesadillaS.jpg', 'quesadilla-2.jpeg', 'tacos-beef.jpg', 'tacos-saumon.jpg', 'tacos.jpg', 'tostadas.jpg', 'viandes.jpg',];
        $pictsName = ['Fajitas', 'Assortiment', 'Buffet fiesta', 'Burritos', 'Carlota', 'Ceviche', 'Cheesecake caramel', 'Chilaquiles rojos', 'Chilaquiles', 'Chilicon', 'Chololat épicé', 'Churros', 'Crevette', 'Empanadas', 'Enchilada', 'Entrées', 'Horchata', 'Crevette', 'Chilaquiles rojos', 'Chilicon', 'Figue', 'Mexican', 'Mexican', 'Plat mexicain', 'Poisson', 'Poisson', 'Poisson', 'Poisson', 'Poisson', 'Pozole', 'Pudding', 'Quesadilla', 'Quesadilla', 'Tacos beef', 'Tacos saumon', 'Tacos', 'Tostadas', 'Viandes',];
        for ($q = 0; $q < count($pictsFilename); $q++) {
            $picture = new Picture();
            $picture->setName($pictsName[$q])
                ->setDescription($faker->text(300))
                ->setFilename($pictsFilename[$q])
                ->setIsFavorite($faker->boolean())
                ->setProduct($faker->unique()->randomElement($products));

            $manager->persist($picture);
        }

        $manager->flush();
    }
}

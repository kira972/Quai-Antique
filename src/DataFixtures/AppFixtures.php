<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Picture;
use App\Entity\Product;
use App\Entity\Formule;
use App\Entity\Category;
use App\Entity\Allergie;
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
        
        for ($i=0; $i < 16; $i++) { 
            $user = New User();
            $user->setFirstName($faker->firstname())
                ->setLastName($faker->lastname())
                ->setEmail($faker->unique()->email())
                ->setPlainPassword('password');
            if($i<2) {
                $user->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_MEMBER']);
            }

            if ($i>1) {
                $membres[] = $user;
            }

            $manager->persist($user);
        }

    //Allergie
        for ($j=0; $j < 10; $j++) { 
            $allergie = new Allergie();
            $allergie->setDescription($faker->word(3))
                ->addUser($faker->unique()->randomElement($membres));
            $allergies[] = $allergie; 
            $manager->persist($allergie);
        }

    //Restaurant
    $restaurant = New Restaurant();
    $restaurant->setName($faker->name('Quai Antique'))
        ->setPhoneNumber($faker->phoneNumber('0596523023'))
        ->setMail($faker->email('QuaiAntique@resto.fr'))
        ->setAddress($faker->address('27, rue du Paradis'))
        ->setPostcode($faker->postcode('44000'))
        ->setCity($faker->city('Nantes'));
        

    $manager->persist($restaurant);


    //Reservation
    for ($k=0; $k < 16; $k++) {

        $date = \DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-3 month', '-1 week'));
        $hours = ['1200', '1230', '1300', '1330', '1400', '1900', '1930', '2000', '2030', '2100', '2130'];

        $reservation = New Reservation();
        $reservation->setAllergie($faker->word())
            ->setUser($faker->unique()->randomElement($membres))
            ->setRestaurant($restaurant)
            ->setDate($date)
            ->setHour(new \Datetime($faker->randomElement($hours)))
            ->setNumberCover(mt_rand(1, 6))
            ->setName($faker->word());

        for ($s=0; $s < mt_rand(0, 3); $s++) { 
            $reservation->addAllergieReserv($faker->unique()->randomElement($allergies));
        }

        $manager->persist($reservation);
    }

    //OpeningTime
    $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    $times = ['12:00','14:00', '19:00', '22:00'];
    for ($l=0; $l < count($days); $l++) { 
        $openingTime = New OpeningTime();
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
    $menu = New Menu();
    $menu->setName($faker->word())
        ->setDescription($faker->text(100));

    $manager->persist($menu);

    //Formule
    for ($n=0; $n < 3; $n++) { 
        $formule = New Formule();
        $formule->setDescription($faker->text(100))
            ->setName($faker->word())
            ->setPrice($faker->randomFloat(1,20,30))
            ->setMenu($menu);

        $manager->persist($formule);
    }

    //Category
    for($o=0; $o < 6; $o++) { 
        $category = New Category();
        $category->setName($faker->word());
        $categories[] = $category;

        $manager->persist($category);
    }

    //Product
    for ($p=0; $p < 16; $p++) { 
        $product = New Product();
        $product->setName($faker->word())
            ->setPrice($faker->randomFloat(1,18,36))
            ->setCategory($faker->randomElement($categories));
        $products[] = $product;

        $manager->persist($product);
    }

    //Picture
    for ($q=0; $q < 6; $q++) { 
        $picture = New Picture();
        $picture->setName($faker->word())
            ->setDescription($faker->text(300))
            ->setFilename("filename.png")
            ->setIsFavorite($faker->boolean())
            ->setProduct($faker->unique()->randomElement($products));

        $manager->persist($picture);
    }

    $manager->flush();
    }
}

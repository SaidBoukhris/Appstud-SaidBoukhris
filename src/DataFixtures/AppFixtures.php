<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Adverts;
use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');
        // Créer utilisateurs
        for($k = 1 ; $k <= 1 ; $k++) {
            $user = new Users();
            $user       -> setFirstName("Saïd")
                        -> setName("Boukhris")
                        -> setEmail("said@gmail.com")
                        -> setRoles(["ROLE_ADMIN"])
                        -> setPassword('$argon2id$v=19$m=65536,t=4,p=1$tb4P6kELu5ZAhqHctvN7HQ$OFyK9GGSzyob0c9ahYNmxT2HumFDiXNolAVFeqCT3bE')
                        -> setImage("https://www.fakepersongenerator.com/Face/male/male1084854850525.jpg");
            $manager    -> persist($user);
        }
            
        // Créer catégories
        for($j = 1 ; $j <= 1; $j++) {
            $categorie = new Categories();
            $categorie  -> setImage("https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fwww.boisfranc.com%2Fcontent%2Fuploads%2Fsites%2F36%2F2018%2F09%2Fcar-png.png&f=1&nofb=1")
                        -> setIcon("car")
                        -> setName("Véhicules");
            $manager    -> persist($categorie);

            // Créer Annonces
            for($i = 1 ; $i <= rand(1,20); $i++) {
                $advert = new Adverts();
                $advert     -> setTitle("Bmw x1 2 0 18d 143cv xline 39000 kms")
                            -> setContent("FRENCH CARS SERVICES 177 Av De Thionville 57050 Metz PROCEDURE PARTICULIERE COVID-19 : LIVRAISON POSSIBLE DANS TOUTE LA FRANCE NOS VEHICULES SONT VISIBLE UNIQUEMENT SUR RDV NOUS VOUS RECEVERONS DANS UN BUREAU UNIQUEMENT PREVU A CET EFFET QUI SERA DESINFECTER ................................. Bmw X1 2.0d 18d 143cv Xline 39.990 kms 04.2014 Manuelle *****1ERE MAIN*****")
                            -> setActive(false)
                            -> setImage("https://img.leboncoin.fr/api/v1/tenants/9a6387a1-6259-4f2c-a887-7e67f23dd4cb/domains/20bda58f-d650-462e-a72a-a5a7ecf2bf88/buckets/24265337-e7cc-489d-80fc-0c564d62a63b/images/8b/a1/85/8ba1852956de593682f9a638ad7daa8d1c72cf65.jpg?rule=ad-large")
                            -> setCategories($categorie)
                            -> setUser($user);
                $manager    -> persist($advert);
            } 
        }        
        $manager->flush();
    }
}

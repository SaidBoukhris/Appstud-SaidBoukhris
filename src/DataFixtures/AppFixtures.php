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
        // Créer catégories
        for($j = 1 ; $j <= 5; $j++) {
            $categorie = new Categories();
                 $categorie  -> setImage("https://placehold.it/250x250")
                -> setName($faker->colorName);
            $manager -> persist($categorie);
          
        // Créer utilisateurs
        for($k = 1 ; $k <= 1 ; $k++) {
            $user   = new Users();
            $user-> setEmail($faker->email)
                 -> setFirstName($faker->firstName)
                 -> setPassword($faker->password)
                 -> setImage("https://placehold.it/50x50")
                 -> setName($faker->lastName);

            $manager -> persist($user);
        }
        // Créer Annonces
        for($j = 1 ; $j <= 15; $j++) {
            $advert = new Adverts();
            $advert -> setTitle($faker->paragraph($nbSentences = 1, $variableNbSentences = false))
                    -> setContent($faker->paragraph($nbSentences = 2, $variableNbSentences = true))
                    -> setActive(false)
                 -> setImage("https://placehold.it/550x550")
                 -> setCategories($categorie)
                    -> setUser($user);
            $manager -> persist($advert);
        }        
         } 
        $manager->flush();
    }
}

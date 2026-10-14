<?php

namespace App\DataFixtures;
use App\Entity\DISCIPLINE;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
   public function load(ObjectManager $manager): void
    {
    

        // Liste de vos disciplines avec leur nom et description (attention à ne pas dépasser 50 caractères pour la description)
        $disciplinesData = [
            [
                'nom' => 'Éveil Musical',
                'description' => 'Cours de découverte pour les plus jeunes.'
            ],
            [
                'nom' => 'Cours instrumental',
                'description' => 'Cours d\'instruments et formation musicale.'
            ],
            [
                'nom' => 'Pratique collective',
                'description' => 'Initiation à l\'orchestre et improvisation.'
            ],
        ];

        foreach ($disciplinesData as $data) {
            $discipline = new DISCIPLINE();
            $discipline->setNom($data['nom']);
            $discipline->setDescription($data['description']);
            
            $manager->persist($discipline);
        }


        $manager->flush();
    }
}

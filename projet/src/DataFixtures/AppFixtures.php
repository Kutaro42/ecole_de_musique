<?php

namespace App\DataFixtures;
<<<<<<< projet/src/DataFixtures/AppFixtures.php
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


        $discipline1 = new Discipline();
        $discipline1->setNom("Éveil musical");
        $discipline1->setDescription("Destiné aux enfants de 3 à 6 ans, l'éveil musical est une initiation ludique et sensorielle. Par le jeu, le chant, l'expression corporelle et la manipulation de petits instruments, l'enfant développe son oreille musicale et son sens du rythme sans apprentissage formel...");

        $manager->persist($discipline1);

        $discipline2 = new Discipline();
        $discipline2->setNom("Cours d'Instruments");
        $discipline2->setDescription("Apprentissage de la pratique instrumentale (piano, guitare, violon, batterie...) accompagné par des professeurs diplômés. Un parcours personnalisé alliant technique et plaisir de jouer");

        $manager->persist($discipline2);

        $discipline3 = new Discipline();
        $discipline3->setNom("Pratique collective");
        $discipline3->setDescription("Chorale, ensembles de musique de chambre ou groupes de musiques actuelles. Partagez votre passion et développez votre écoute au sein d\'un groupe.");
        $manager->persist($discipline3);
        ];

        foreach ($disciplinesData as $data) {
            $discipline = new DISCIPLINE();
            $discipline->setNom($data['nom']);
            $discipline->setDescription($data['description']);
            
            $manager->persist($discipline);
        }
    }
}

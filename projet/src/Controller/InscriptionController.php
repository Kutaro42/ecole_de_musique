<?php

namespace App\Controller;
//classes intervenant dans le formulaire d'inscription
use App\Entity\INSCRIPTION;
use App\Entity\ELEVE;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use DateTime; // Pour manipuler les dates en PHP

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InscriptionController extends AbstractController
{

    #[Route('/preinscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // On instancie uniquement l'inscription vide
        $inscription = new INSCRIPTION();

        // On crée le formulaire lié à cette inscription
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        // Récupérer l'élève lié à l'inscription
        $eleve = $inscription->getIdEleve(); 

        // Récupérer précisément le responsable légal 1
        $responsable1 = $inscription->getIdResponsableLegal1(); 
            
        if ($eleve && $eleve->getDateNaissance()) {
            $dateNaissance = $eleve->getDateNaissance();
            $aujourdhui = new DateTime();
            
            // Calculer la différence d'âge précise (prend en compte le jour et le mois)
            $difference = $aujourdhui->diff($dateNaissance);
            $age = $difference->y; // Récupère le nombre d'années
            
            // Assigner l'âge à l'élève
            $eleve->setAge($age);
            
            // Déterminer la majorité (vrai si 18 ans ou plus, sinon faux)

            $estMajeur = ($age >= 18);
            $eleve->setEleveMajeur($estMajeur); 
            // Remplacer $responsable par $responsable1
            if ($estMajeur && $responsable1) {
                $responsable1->setNom($eleve->getNom());
                $responsable1->setPrenom($eleve->getPrenom());
                $responsable1->setEmail($eleve->getEmail());
                
                // Note : le champ de l'élève s'appelle 'tel_portable' dans le Twig
                $responsable1->setTelPortable($eleve->getTelPortable());
                $responsable1->setTelProfessionnel($eleve->getTelPortable()); 
  
            }
            // SÉCURITÉ SERVEUR : Si l'élève est MINEUR et que le nom du parent est vide
            elseif (!$estMajeur && (!$responsable1 || empty($responsable1->getNom()))) {
                // On ajoute une erreur globale au formulaire et on réaffiche la page
                $this->addFlash('error', "Erreur : Les coordonnées du responsable légal 1 sont obligatoires pour un élève mineur.");
                
                return $this->render('inscription/preinscription.html.twig', [
                    'form_inscription' => $form->createView(),
                ]);
            }
        }

        if ($form->isSubmitted() && $form->isValid()) {
            // Le formulaire a déjà injecté le bon objet COURS dans l'inscription ($inscription->getIdCours())
            
            $entityManager->persist($inscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_confirmation');
        }

        return $this->render('inscription/preinscription.html.twig', [
            'form_inscription' => $form->createView(),
        ]);
        
    }
    #[Route('/inscription/confirmation', name: 'app_confirmation')]
    public function confirmation(): Response
    {
        return $this->render('inscription/confirmation.html.twig');
    } 
}

<?php

namespace App\Controller;
//classes intervenant dans le formulaire d'inscription
use App\Entity\INSCRIPTION;
use App\Entity\ELEVE;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InscriptionController extends AbstractController
{

    #[Route('/preinscription', name: 'app_inscription')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // 1. On instancie uniquement l'inscription vide
        $inscription = new INSCRIPTION();

        // 2. On crée le formulaire lié à cette inscription
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

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

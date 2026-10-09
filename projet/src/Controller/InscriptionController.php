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
        // On crée d'abord les objets vides en mémoire
        $inscription = new INSCRIPTION();
        $eleve = new ELEVE();

        // Puis on lie l'élève à l'inscription pour l'imbrication
        $inscription->setIdEleve($eleve);

        // on génère le formulaire et on analyse la requête HTTP
        $form = $this->createForm(InscriptionType::class, $inscription);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide, on enregistre
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($inscription);
            $entityManager->flush();

            $this->addFlash('success', 'Félicitations, l\'inscription a bien été validée !');

            return $this->redirectToRoute('app_inscription');
        }

        // 5. Sinon, on affiche la vue Twig en lui passant le formulaire
        return $this->render('inscription/preinscription.html.twig', [
            'form_inscription' => $form->createView(),
        ]);

    } 
} 


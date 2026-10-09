<?php

namespace App\Controller;

use App\Repository\DISCIPLINERepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MusicController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(DISCIPLINERepository $disciplineRepository): Response
    {
        $disciplines = $disciplineRepository->findAll();

        return $this->render('accueil.html.twig', [
            'disciplines' => $disciplines,
        ]);
    }

    #[Route('/enseignements', name: 'enseignements')]
    public function enseignements(\App\Repository\DISCIPLINERepository $disciplineRepository): Response
    {
        return $this->render('enseignements.html.twig', [
            'disciplines' => $disciplineRepository->findAll(),
        ]);
    }
}

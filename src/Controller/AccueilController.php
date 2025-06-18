<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $date = new \DateTime();
        return $this->render('accueil/home.html.twig', [
            'controller_name' => 'AccueilController',
            'current_date' => $date
        ]);
    }
}

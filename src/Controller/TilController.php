<?php

namespace App\Controller;

use App\Repository\TilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TilController extends AbstractController
{
    #[Route('/til', name: 'app_til')]
    public function index(TilRepository $tilRepo): Response
    {
        $tils = $tilRepo->findAll();

        return $this->render('pages/til/index.html.twig', [
            'tils' => $tils,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(GameRepository $gameRepository): Response
    {

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'game' => $gameRepository->findBy(array(), array('id' => 'DESC'), 10, 0),
            'lastGame' => $gameRepository->findOneBy(array(), array('id' => 'DESC')),
        ]);
    }
}

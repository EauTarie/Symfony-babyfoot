<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArbiterController extends AbstractController
{
    #[Route('/arbiter', name: 'app_arbiter')]
    public function index(): Response
    {
        return $this->render('arbiter/index.html.twig', [
            'controller_name' => 'ArbiterController',
        ]);
    }
}

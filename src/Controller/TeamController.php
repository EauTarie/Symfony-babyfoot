<?php

namespace App\Controller;

use App\Entity\Team;
use App\Entity\PlayerTeam;
use App\Entity\User;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/team')]
class TeamController extends AbstractController
{
    #[Route('/', name: 'app_team_index', methods: ['GET'])]
    public function index(TeamRepository $teamRepository, EntityManagerInterface $entityManager): Response
    {
        return $this->render('team/index.html.twig', [
            'teams' => $teamRepository->findAll(),
        ]);
    }

    #[Route('/list', name:'app_team_list', methods: ['GET'])]
    public function list(PlayerTeam $playerTeam, EntityManagerInterface $entityManager):Response
    {
        $currentUser = $this->getUser();
        $playerTeamRepository = $entityManager->getRepository(PlayerTeam::class);
        $userTeamCollection = $playerTeamRepository->findBy(['id_player' => $currentUser]);
        return $this->render('team/list.html.twig', [
            'playerTeams' => $userTeamCollection,
        ]);
    }
    #[Route('/new', name: 'app_team_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $team = new Team();
        $team->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('Europe/Paris')));
        $team->setUpdatedAt(new \DateTime('now', new \DateTimeZone('Europe/Paris')));
        $team->setStatus('active');
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('team/new.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_team_show', methods: ['GET'])]
    public function show(Team $team): Response
    {

        return $this->render('team/show.html.twig', [
            'team' => $team,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_team_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('team/edit.html.twig', [
            'team' => $team,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_team_delete', methods: ['POST'])]
    public function delete(Request $request, Team $team, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$team->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_team_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/join/{id}', name:'app_team_join', methods: ['GET', 'POST'])]
    public function join(Request $request, EntityManagerInterface $entityManager): Response
    {

        $currentUser = $this->getUser();
        $teamPlayerRepository = $entityManager->getRepository(PlayerTeam::class);
        $playerTeamCollection = $teamPlayerRepository->findBy(['id_player' => $currentUser]);
        $currentTeam = $request->attributes->get('id');
        if(!$playerTeamCollection) {
//        dd($playerTeamCollection, $currentTeam);
            $teamRepository = $entityManager->getRepository(Team::class);
            $playerTeam = new PlayerTeam();
            $team = $teamRepository->findOneBy(['id' => $currentTeam]);
            $playerTeam->setIdTeam($team);
            $playerTeam->setIdPlayer($currentUser);
            $entityManager->persist($playerTeam);
            $entityManager->flush();
        } else {
            dd('non');
        }

        return $this->redirectToRoute('app_team_index');
    }
}

<?php

namespace App\Entity;

use App\Repository\PlayerTeamRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerTeamRepository::class)]
class PlayerTeam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'playerTeams')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $id_player = null;

    #[ORM\ManyToOne(inversedBy: 'playerTeams')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $id_team = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPlayer(): ?User
    {
        return $this->id_player;
    }

    public function setIdPlayer(?User $id_player): static
    {
        $this->id_player = $id_player;

        return $this;
    }

    public function getIdTeam(): ?Team
    {
        return $this->id_team;
    }

    public function setIdTeam(?Team $id_team): static
    {
        $this->id_team = $id_team;

        return $this;
    }
}

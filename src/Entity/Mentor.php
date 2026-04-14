<?php

namespace App\Entity;

use App\Repository\MentorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MentorRepository::class)]
class Mentor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $profession = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $bio = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $disponibilite = null;

    #[ORM\OneToOne(inversedBy: "mentor")]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int { return $this->id; }

    public function getProfession(): ?string { return $this->profession; }
    public function setProfession(string $profession): static { $this->profession = $profession; return $this; }

    public function getBio(): ?string { return $this->bio; }
    public function setBio(?string $bio): static { $this->bio = $bio; return $this; }

    public function getDisponibilite(): ?string { return $this->disponibilite; }
    public function setDisponibilite(?string $d): static { $this->disponibilite = $d; return $this; }

    public function getUser(): ?User { return $this->user; }
    public function setUser(User $user): static { $this->user = $user; return $this; }
}
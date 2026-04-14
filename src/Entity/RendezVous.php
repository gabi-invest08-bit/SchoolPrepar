<?php

namespace App\Entity;

use App\Repository\RendezVousRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RendezVousRepository::class)]
class RendezVous
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $eleve = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mentor $mentor = null;

    public function getId(): ?int { return $this->id; }

    public function getDate(): ?\DateTimeInterface { return $this->date; }
    public function setDate(\DateTimeInterface $d): static { $this->date = $d; return $this; }

    public function getStatut(): ?string { return $this->statut; }
    public function setStatut(string $s): static { $this->statut = $s; return $this; }

    public function getEleve(): ?User { return $this->eleve; }
    public function setEleve(User $u): static { $this->eleve = $u; return $this; }

    public function getMentor(): ?Mentor { return $this->mentor; }
    public function setMentor(Mentor $m): static { $this->mentor = $m; return $this; }
}
<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "text")]
    private ?string $contenu = null;

    #[ORM\Column(type: "datetime")]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $expediteur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $destinataire = null;

    public function getId(): ?int { return $this->id; }

    public function getContenu(): ?string { return $this->contenu; }
    public function setContenu(string $c): static { $this->contenu = $c; return $this; }

    public function getDate(): ?\DateTimeInterface { return $this->date; }
    public function setDate(\DateTimeInterface $d): static { $this->date = $d; return $this; }

    public function getExpediteur(): ?User { return $this->expediteur; }
    public function setExpediteur(User $u): static { $this->expediteur = $u; return $this; }

    public function getDestinataire(): ?User { return $this->destinataire; }
    public function setDestinataire(User $u): static { $this->destinataire = $u; return $this; }
}
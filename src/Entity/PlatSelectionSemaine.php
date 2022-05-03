<?php

namespace App\Entity;

use App\Repository\PlatSelectionSemaineRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatSelectionSemaineRepository::class)]
class PlatSelectionSemaine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $jour;

    #[ORM\Column(type: 'integer')]
    private $quantiteJour;

    #[ORM\ManyToOne(targetEntity: Contient::class, inversedBy: 'platSelectionSemaines')]
    #[ORM\JoinColumn(nullable: false)]
    private $contient;

    #[ORM\ManyToOne(targetEntity: Selectionne::class, inversedBy: 'platSelectionSemaine')]
    #[ORM\JoinColumn(nullable: false)]
    private $selectionne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): self
    {
        $this->jour = $jour;

        return $this;
    }

    public function getQuantiteJour(): ?int
    {
        return $this->quantiteJour;
    }

    public function setQuantiteJour(int $quantiteJour): self
    {
        $this->quantiteJour = $quantiteJour;

        return $this;
    }

    public function getContient(): ?Contient
    {
        return $this->contient;
    }

    public function setContient(?Contient $contient): self
    {
        $this->contient = $contient;

        return $this;
    }

    public function getSelectionne(): ?Selectionne
    {
        return $this->selectionne;
    }

    public function setSelectionne(?Selectionne $selectionne): self
    {
        $this->selectionne = $selectionne;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\SelectionneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SelectionneRepository::class)]
class Selectionne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'selectionne', targetEntity: PlatSelectionSemaine::class)]
    private $platSelectionSemaine;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'selectionnes')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    public function __construct()
    {
        $this->platSelectionSemaine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PlatSelectionSemaine>
     */
    public function getPlatSelectionSemaine(): Collection
    {
        return $this->platSelectionSemaine;
    }

    public function addPlatSelectionSemaine(PlatSelectionSemaine $platSelectionSemaine): self
    {
        if (!$this->platSelectionSemaine->contains($platSelectionSemaine)) {
            $this->platSelectionSemaine[] = $platSelectionSemaine;
            $platSelectionSemaine->setSelectionne($this);
        }

        return $this;
    }

    public function removePlatSelectionSemaine(PlatSelectionSemaine $platSelectionSemaine): self
    {
        if ($this->platSelectionSemaine->removeElement($platSelectionSemaine)) {
            // set the owning side to null (unless already changed)
            if ($platSelectionSemaine->getSelectionne() === $this) {
                $platSelectionSemaine->setSelectionne(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

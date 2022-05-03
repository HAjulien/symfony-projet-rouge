<?php

namespace App\Entity;

use App\Repository\ContientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContientRepository::class)]
class Contient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'contient', targetEntity: PlatSelectionSemaine::class, orphanRemoval: true)]
    private $platSelectionSemaines;

    #[ORM\OneToMany(mappedBy: 'contient', targetEntity: Plat::class)]
    private $plat;

    public function __construct()
    {
        $this->platSelectionSemaines = new ArrayCollection();
        $this->plat = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, PlatSelectionSemaine>
     */
    public function getPlatSelectionSemaines(): Collection
    {
        return $this->platSelectionSemaines;
    }

    public function addPlatSelectionSemaine(PlatSelectionSemaine $platSelectionSemaine): self
    {
        if (!$this->platSelectionSemaines->contains($platSelectionSemaine)) {
            $this->platSelectionSemaines[] = $platSelectionSemaine;
            $platSelectionSemaine->setContient($this);
        }

        return $this;
    }

    public function removePlatSelectionSemaine(PlatSelectionSemaine $platSelectionSemaine): self
    {
        if ($this->platSelectionSemaines->removeElement($platSelectionSemaine)) {
            // set the owning side to null (unless already changed)
            if ($platSelectionSemaine->getContient() === $this) {
                $platSelectionSemaine->setContient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Plat>
     */
    public function getPlat(): Collection
    {
        return $this->plat;
    }

    public function addPlat(Plat $plat): self
    {
        if (!$this->plat->contains($plat)) {
            $this->plat[] = $plat;
            $plat->setContient($this);
        }

        return $this;
    }

    public function removePlat(Plat $plat): self
    {
        if ($this->plat->removeElement($plat)) {
            // set the owning side to null (unless already changed)
            if ($plat->getContient() === $this) {
                $plat->setContient(null);
            }
        }

        return $this;
    }
}

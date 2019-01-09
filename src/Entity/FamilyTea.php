<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FamilyTeaRepository")
 */
class FamilyTea
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Assert notBlank, maxLength 255
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tea", mappedBy="familyTea")
     */
    private $teas;

    public function __construct()
    {
        $this->teas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Tea[]
     */
    public function getTeas(): Collection
    {
        return $this->teas;
    }

    public function addTea(Tea $tea): self
    {
        if (!$this->teas->contains($tea)) {
            $this->teas[] = $tea;
            $tea->setFamilyTea($this);
        }

        return $this;
    }

    public function removeTea(Tea $tea): self
    {
        if ($this->teas->contains($tea)) {
            $this->teas->removeElement($tea);
            // set the owning side to null (unless already changed)
            if ($tea->getFamilyTea() === $this) {
                $tea->setFamilyTea(null);
            }
        }

        return $this;
    }
}

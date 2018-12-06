<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Shelf")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shelf;

    /**
     * @ORM\OneToMany(targetEntity="Infusion", mappedBy="category")
     */
    private $infusions;

    public function __construct()
    {
        $this->infusions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getShelf(): ?Shelf
    {
        return $this->shelf;
    }

    public function setShelf(?Shelf $shelf): self
    {
        $this->shelf = $shelf;

        return $this;
    }

    /**
     * @return Collection|Infusion[]
     */
    public function getInfusions(): Collection
    {
        return $this->infusions;
    }

    public function addInfusion(Infusion $infusion): self
    {
        if (!$this->infusions->contains($infusion)) {
            $this->infusions[] = $infusion;
            $infusion->setCategory($this);
        }

        return $this;
    }

    public function removeInfusionProduct(Infusion $infusion): self
    {
        if ($this->infusions->contains($infusion)) {
            $this->infusions->removeElement($infusion);
            // set the owning side to null (unless already changed)
            if ($infusion->getCategory() === $this) {
                $infusion->setCategory(null);
            }
        }

        return $this;
    }
}

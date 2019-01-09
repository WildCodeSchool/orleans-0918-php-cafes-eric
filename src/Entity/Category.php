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
     * @ORM\OneToMany(targetEntity="Tea", mappedBy="category")
     */
    private $teas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coffee", mappedBy="category")
     */
    private $coffees;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Infusion", mappedBy="category")
     */
    private $infusions;

    public function __construct()
    {
        $this->coffees = new ArrayCollection();
        $this->teas = new ArrayCollection();
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

    public function setTitle(?string $title): self
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
     * @return Collection|Coffee[]
     */
    public function getCoffees(): Collection
    {
        return $this->coffees;
    }

    public function addCoffee(Coffee $coffee): self
    {
        if (!$this->coffees->contains($coffee)) {
            $this->coffees[] = $coffee;
            $coffee->setCategory($this);
        }
        return $this;
    }
    
    public function removeCoffee(Coffee $coffee): self
    {
        if ($this->coffees->contains($coffee)) {
            $this->coffees->removeElement($coffee);
            // set the owning side to null (unless already changed)
            if ($coffee->getCategory() === $this) {
                $coffee->setCategory(null);
            }
        }
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
            $tea->setCategory($this);
        }

        return $this;
    }
    
    public function removeTea(Tea $tea): self
    {
        if ($this->teas->contains($tea)) {
            $this->teas->removeElement($tea);
            // set the owning side to null (unless already changed)
            if ($tea->getCategory() === $this) {
                $tea->setCategory(null);
            }
        }
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

    public function removeInfusion(Infusion $infusion): self
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

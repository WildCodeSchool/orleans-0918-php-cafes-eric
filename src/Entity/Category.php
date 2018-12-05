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
     * @ORM\OneToMany(targetEntity="App\Entity\InfusionProduct", mappedBy="category")
     */
    private $infusionProducts;

    public function __construct()
    {
        $this->infusionProducts = new ArrayCollection();
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
     * @return Collection|InfusionProduct[]
     */
    public function getInfusionProducts(): Collection
    {
        return $this->infusionProducts;
    }

    public function addInfusionProduct(InfusionProduct $infusionProduct): self
    {
        if (!$this->infusionProducts->contains($infusionProduct)) {
            $this->infusionProducts[] = $infusionProduct;
            $infusionProduct->setCategory($this);
        }

        return $this;
    }

    public function removeInfusionProduct(InfusionProduct $infusionProduct): self
    {
        if ($this->infusionProducts->contains($infusionProduct)) {
            $this->infusionProducts->removeElement($infusionProduct);
            // set the owning side to null (unless already changed)
            if ($infusionProduct->getCategory() === $this) {
                $infusionProduct->setCategory(null);
            }
        }

        return $this;
    }
}

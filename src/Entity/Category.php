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
     * @ORM\OneToMany(targetEntity="App\Entity\TeaProduct", mappedBy="category")
     */
    private $teaProducts;

    public function __construct()
    {
        $this->teaProducts = new ArrayCollection();
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
     * @return Collection|TeaProduct[]
     */
    public function getTeaProducts(): Collection
    {
        return $this->teaProducts;
    }

    public function addTeaProduct(TeaProduct $teaProduct): self
    {
        if (!$this->teaProducts->contains($teaProduct)) {
            $this->teaProducts[] = $teaProduct;
            $teaProduct->setCategory($this);
        }

        return $this;
    }

    public function removeTeaProduct(TeaProduct $teaProduct): self
    {
        if ($this->teaProducts->contains($teaProduct)) {
            $this->teaProducts->removeElement($teaProduct);
            // set the owning side to null (unless already changed)
            if ($teaProduct->getCategory() === $this) {
                $teaProduct->setCategory(null);
            }
        }

        return $this;
    }
}

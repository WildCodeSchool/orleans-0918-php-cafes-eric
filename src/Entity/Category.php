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

    public function __construct()
    {
        $this->teas = new ArrayCollection();
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
}

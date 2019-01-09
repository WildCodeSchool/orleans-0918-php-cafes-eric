<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InfusionRepository")
 */
class Infusion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Nom trop grand"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Liste d'ingrédients trop longue"
     * )
     */
    private $ingredients;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="infusions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Particularité trop petite",
     *     maxMessage="Trop grand"
     * )
     */
    private $feature;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $highlighted;
  
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $novelty;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FamilyTea", inversedBy="infusion")
     */
    private $familyTea;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Infusion", inversedBy="infusions")
     */
    private $familyInfusion;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Infusion", mappedBy="familyInfusion")
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(?string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFeature(): ?string
    {
        return $this->feature;
    }

    public function setFeature(?string $feature): self
    {
        $this->feature = $feature;

        return $this;
    }
  
    public function getHighlighted(): ?bool
    {
        return $this->highlighted;
    }

    public function setHighlighted(?bool $highlighted): self
    {
        $this->highlighted = $highlighted;
        return $this;
    }
  
    public function getNovelty(): ?bool
    {
        return $this->novelty;
    }

    public function setNovelty(?bool $novelty): self
    {
        $this->novelty = $novelty;

        return $this;
    }

    public function getFamilyInfusion(): ?self
    {
        return $this->familyInfusion;
    }

    public function setFamilyInfusion(?self $familyInfusion): self
    {
        $this->familyInfusion = $familyInfusion;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getInfusions(): Collection
    {
        return $this->infusions;
    }

    public function addInfusion(self $infusion): self
    {
        if (!$this->infusions->contains($infusion)) {
            $this->infusions[] = $infusion;
            $infusion->setFamilyInfusion($this);
        }

        return $this;
    }

    public function removeInfusion(self $infusion): self
    {
        if ($this->infusions->contains($infusion)) {
            $this->infusions->removeElement($infusion);
            // set the owning side to null (unless already changed)
            if ($infusion->getFamilyInfusion() === $this) {
                $infusion->setFamilyInfusion(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeaRepository")
 * @UniqueEntity("name")
 */
class Tea
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $hightlighted;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $novelty;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Particularité trop petit",
     *     maxMessage="Trop grand"
     * )
     */
    private $feature;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="teas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FamilyTea", inversedBy="tea")
     * @ORM\JoinColumn(nullable=false)
     */
    private $familyTea;

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

    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(string $ingredients): self
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getHightlighted(): ?bool
    {
        return $this->hightlighted;
    }

    public function setHightlighted(bool $hightlighted): self
    {
        $this->hightlighted = $hightlighted;

        return $this;
    }

    public function getNovelty(): ?bool
    {
        return $this->novelty;
    }

    public function setNovelty(bool $novelty): self
    {
        $this->novelty = $novelty;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getFamilyTea(): ?FamilyTea
    {
        return $this->familyTea;
    }

    public function setFamilyTea(?FamilyTea $familyTea): self
    {
        $this->familyTea = $familyTea;

        return $this;
    }
}

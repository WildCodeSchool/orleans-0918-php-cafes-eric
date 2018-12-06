<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeaRepository")
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
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hightlighted;

    /**
     * @ORM\Column(type="boolean")
     */
    private $novelty;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tastingNote;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="teas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getTastingNote(): ?string
    {
        return $this->tastingNote;
    }

    public function setTastingNote(string $tastingNote): self
    {
        $this->tastingNote = $tastingNote;

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
}

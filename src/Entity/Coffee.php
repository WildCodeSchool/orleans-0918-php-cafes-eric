<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoffeeRepository")
 */
class Coffee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *      max=255,
     *      maxMessage="Le nom du pays est trop long"
     * )
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank
     * @Assert\Length(
     *     max=255,
     *     maxMessage=" Le nom du terroir est trop long"
     * )
     */
    private $soil;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Le nom de la variété trop long"
     * )
     */
    private $variety;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(
     *     max=255,
     *     maxMessage="La note de dégustation est trop longue"
     * )
     */
    private $tastingNote;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $highlighted;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $novelty;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="coffees")
     */
    private $category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getSoil(): ?string
    {
        return $this->soil;
    }

    public function setSoil(?string $soil): self
    {
        $this->soil = $soil;

        return $this;
    }

    public function getVariety(): ?string
    {
        return $this->variety;
    }

    public function setVariety(string $variety): self
    {
        $this->variety = $variety;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getHighlighted(): ?bool
    {
        return $this->highlighted;
    }

    public function setHighlighted(bool $highlighted): self
    {
        $this->highlighted = $highlighted;

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

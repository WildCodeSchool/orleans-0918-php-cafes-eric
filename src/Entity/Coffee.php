<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoffeeRepository")
 * @Vich\Uploadable()
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
     * @ORM\Column(type="string", length=2, nullable=true)
     * @Assert\NotBlank
     * @Assert\Country
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

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $coffeeImage;

    /**
     * @Vich\UploadableField(mapping="coffee", fileNameProperty="coffeeImage")
     * @var File
     * @Assert\NotBlank
     * @Assert\Image(
     *     maxWidth="300",
     *     maxHeight="300",
     *     maxWidthMessage="La largeur ne doit pas excéder 300 px",
     *     maxHeightMessage="La longueur ne doit pas excéder 300 px")
     */
    private $coffeeImageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    public function getCoffeeImageFile() : ?UploadedFile
    {
        return $this->coffeeImageFile;
    }
    public function setCoffeeImageFile(File $image = null) : void
    {
        $this->coffeeImageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if (null !== $image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }
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
    public function getCoffeeImage(): ?string
    {
        return $this->coffeeImage;
    }

    public function setCoffeeImage(string $coffeeImage): self
    {
        $this->coffeeImage = $coffeeImage;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}

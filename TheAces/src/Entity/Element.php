<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Endroid\QrCode\Builder\BuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * Element
 *
 * @ORM\Table(name="element")
 * @ORM\Entity
 */
class Element
{
    /**
     * @var int
     * *@Assert\Positive
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Promotion::class, mappedBy="idprod")
     * @JoinColumn(onDelete="CASCADE")
     */
    private $promotions;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\NotNull
     * @ORM\Column(name="type", type="string", length=10, nullable=false)
     */
    private $type;

    /**
     * @var string
     *@Assert\NotBlank
     * @ORM\Column(name="ref", type="string", length=30, nullable=false)
     */
    private $ref;

    /**
     * @var string
     *@Assert\NotBlank
     * @Assert\NotNull
     * @ORM\Column(name="nom", type="string", length=10, nullable=false)
     */
    private $nom;

    /**
     * @var float
     *@Assert\NotBlank
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var string
     *@Assert\Positive
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string|null
     * @ORM\Column(name="image", type="string", length=30, nullable=false)
     */
    private $image;

    /**
     * @var string
     *@Assert\NotBlank
     * @ORM\Column(name="etat", type="string", length=10, nullable=false)
     */
    private $etat;

    /**
     * @var int
     *@Assert\NotBlank
     * @Assert\NotNull
     * @ORM\Column(name="quantite", type="integer", nullable=false)
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
    public function __toString() {
        return $this->getNom();
    }


}

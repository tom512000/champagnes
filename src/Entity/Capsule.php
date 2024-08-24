<?php

namespace App\Entity;

use App\Repository\CapsuleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CapsuleRepository::class)]
class Capsule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $producteur = "";

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $embleme = "";

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couleur = "";

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $matiere = "";

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $inscription = "";

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $decoration = "";

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieu = "";

    #[ORM\Column(length: 10)]
    private string $taille; // "petit" ou "normal"

    #[ORM\Column(type: "boolean")]
    private bool $coffret = false; // true ou false

    #[ORM\Column(type: "float", scale: 2, nullable: true)]
    private ?float $prix = 0.0;

    #[ORM\Column(type: "integer", length: 1)]
    private int $etat; // Entre 1 et 5

    #[ORM\Column(type: "integer", length: 1)]
    private int $quantite;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image;

    public function getId(): int
    {
        return $this->id;
    }

    public function getProducteur(): ?string
    {
        return $this->producteur;
    }

    public function setProducteur(?string $producteur): static
    {
        $this->producteur = $producteur ?: null;

        return $this;
    }

    public function getEmbleme(): ?string
    {
        return $this->embleme;
    }

    public function setEmbleme(?string $embleme): static
    {
        $this->embleme = $embleme ?: null;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(?string $couleur): static
    {
        $this->couleur = $couleur ?: null;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(?string $matiere): static
    {
        $this->matiere = $matiere ?: null;

        return $this;
    }

    public function getInscription(): ?string
    {
        return $this->inscription;
    }

    public function setInscription(?string $inscription): static
    {
        $this->inscription = $inscription ?: null;

        return $this;
    }

    public function getDecoration(): ?string
    {
        return $this->decoration;
    }

    public function setDecoration(?string $decoration): static
    {
        $this->decoration = $decoration ?: null;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): static
    {
        $this->lieu = $lieu ?: null;

        return $this;
    }

    public function getTaille(): string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getCoffret(): bool
    {
        return $this->coffret;
    }

    public function setCoffret(bool $coffret): static
    {
        $this->coffret = $coffret;

        return $this;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix ?: null;

        return $this;
    }

    public function getEtat(): int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): static
    {
        $this->etat = $etat;

        return $this;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}

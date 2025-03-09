<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 150)]
    private ?string $nomCours = null;

    #[ORM\Column(type: "string", length: 50, unique: true)]
    private ?string $codeCours = null;

    #[ORM\Column(type: "integer")]
    private ?int $nbHeures = null;

    // Getter and Setter methods

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCours(): ?string
    {
        return $this->nomCours;
    }

    public function setNomCours(string $nomCours): self
    {
        $this->nomCours = $nomCours;
        return $this;
    }

    public function getCodeCours(): ?string
    {
        return $this->codeCours;
    }

    public function setCodeCours(string $codeCours): self
    {
        $this->codeCours = $codeCours;
        return $this;
    }

    public function getNbHeures(): ?int
    {
        return $this->nbHeures;
    }

    public function setNbHeures(int $nbHeures): self
    {
        $this->nbHeures = $nbHeures;
        return $this;
    }
}

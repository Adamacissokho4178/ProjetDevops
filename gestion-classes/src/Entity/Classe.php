<?php

// src/Entity/Classe.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'classe')]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100)]
    private string $nom_classe;

    #[ORM\Column(type: 'string', length: 50)]
    private string $niveau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClasse(): string
    {
        return $this->nom_classe;
    }

    public function setNomClasse(string $nom_classe): self
    {
        $this->nom_classe = $nom_classe;
        return $this;
    }

    public function getNiveau(): string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;
        return $this;
    }
}

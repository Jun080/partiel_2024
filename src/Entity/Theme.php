<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ThemeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $theme = null;

    #[ORM\Column(name: "nombre_places_gagnants", type: "integer")]
    private ?int $nombrePlacesGagnants = null;

    #[ORM\Column(type: "json")]
    private $propositions = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): static
    {
        $this->theme = $theme;

        return $this;
    }

    public function getNombrePlacesGagnants(): ?int
    {
        return $this->nombrePlacesGagnants;
    }

    public function setNombrePlacesGagnants(?int $nombrePlacesGagnants ): self
    {
        $this->nombrePlacesGagnants  = $nombrePlacesGagnants ;

        return $this;
    }

    public function getPropositions(): ?array
    {
        return $this->propositions;
    }

    public function setPropositions(?array $propositions): self
    {
        $this->propositions = $propositions;

        return $this;
    }
}

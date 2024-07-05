<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\VoteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: VoteRepository::class)]
class Vote
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, Bulletin>
     */
    #[ORM\OneToMany(targetEntity: Bulletin::class, mappedBy: 'vote', orphanRemoval: true)]
    private Collection $bulletin;

    public function __construct()
    {
        $this->bulletin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Bulletin>
     */
    public function getBulletin(): Collection
    {
        return $this->bulletin;
    }

    public function addBulletin(Bulletin $bulletin): static
    {
        if (!$this->bulletin->contains($bulletin)) {
            $this->bulletin->add($bulletin);
            $bulletin->setVote($this);
        }

        return $this;
    }

    public function removeBulletin(Bulletin $bulletin): static
    {
        if ($this->bulletin->removeElement($bulletin)) {
            // set the owning side to null (unless already changed)
            if ($bulletin->getVote() === $this) {
                $bulletin->setVote(null);
            }
        }

        return $this;
    }
}

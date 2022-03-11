<?php

namespace App\Entity;

use App\Repository\TrackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrackRepository::class)]
class Track
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $playcount;

    #[ORM\ManyToMany(targetEntity: Artisty::class, mappedBy: 'tracks')]
    private $artisties;

    public function __construct()
    {
        $this->artisties = new ArrayCollection();
    }

    public function __toString() {
        return $this->name;
    }

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

    public function getPlaycount(): ?int
    {
        return $this->playcount;
    }

    public function setPlaycount(int $playcount): self
    {
        $this->playcount = $playcount;

        return $this;
    }

    /**
     * @return Collection<int, Artisty>
     */
    public function getArtisties(): Collection
    {
        return $this->artisties;
    }

    public function addArtisty(Artisty $artisty): self
    {
        if (!$this->artisties->contains($artisty)) {
            $this->artisties[] = $artisty;
            $artisty->addTrack($this);
        }

        return $this;
    }

    public function removeArtisty(Artisty $artisty): self
    {
        if ($this->artisties->removeElement($artisty)) {
            $artisty->removeTrack($this);
        }

        return $this;
    }
}

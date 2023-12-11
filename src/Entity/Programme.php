<?php

namespace App\Entity;

use App\Repository\ProgrammeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



#[ORM\Entity(repositoryClass: ProgrammeRepository::class)]

#[UniqueEntity(('title'), message: 'ce titre existe déjà')]
class Programme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: 'Ne me laisse pas tout vide')]
    private ?string $synopsis = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poster = null;

    #[ORM\ManyToOne(inversedBy: 'programmes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    #[ORM\OneToMany(mappedBy: 'programme', targetEntity: Season::class)]
    private Collection $seasons;

    #[ORM\ManyToMany(targetEntity: Actor::class, mappedBy: 'programmes')]
    private Collection $actors;

    public function __construct()
    {
        $this->seasons = new ArrayCollection();
        $this->actors = new ArrayCollection();
    }

    public function addSeason(Season $season): void
    {
        if (!$this->seasons->contains($season)) {
            $this->seasons[] = $season;
            $season->setProgramme($this); // Set the current program to the season
        }
    }

    public function removeSeason(Season $season): void
    {
        if ($this->seasons->removeElement($season)) {
            // If the program was set on the season, set it to null
            if ($season->getProgramme() === $this) {
                $season->setProgramme(null);
            }
        }
    }

    public function getSeasons(): Collection
    {
        return $this->seasons;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(?string $poster): static
    {
        $this->poster = $poster;

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

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
            $actor->addProgramme($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        if ($this->actors->removeElement($actor)) {
            $actor->removeProgramme($this);
        }

        return $this;
    }
}

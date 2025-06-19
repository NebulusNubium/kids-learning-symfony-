<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $science = null;

    #[ORM\Column(length: 255)]
    private ?string $literature = null;

    #[ORM\Column(length: 255)]
    private ?string $maths = null;

    /**
     * @var Collection<int, Cours>
     */
    #[ORM\OneToMany(targetEntity: Cours::class, mappedBy: 'matiere_id')]
    private Collection $cours_id;

    public function __construct()
    {
        $this->cours_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScience(): ?string
    {
        return $this->science;
    }

    public function setScience(string $science): static
    {
        $this->science = $science;

        return $this;
    }

    public function getLiterature(): ?string
    {
        return $this->literature;
    }

    public function setLiterature(string $literature): static
    {
        $this->literature = $literature;

        return $this;
    }

    public function getMaths(): ?string
    {
        return $this->maths;
    }

    public function setMaths(string $maths): static
    {
        $this->maths = $maths;

        return $this;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCoursId(): Collection
    {
        return $this->cours_id;
    }

    public function addCoursId(Cours $coursId): static
    {
        if (!$this->cours_id->contains($coursId)) {
            $this->cours_id->add($coursId);
            $coursId->setMatiereId($this);
        }

        return $this;
    }

    public function removeCoursId(Cours $coursId): static
    {
        if ($this->cours_id->removeElement($coursId)) {
            // set the owning side to null (unless already changed)
            if ($coursId->getMatiereId() === $this) {
                $coursId->setMatiereId(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CoursRepository::class)]
class Cours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTime $durée = null;

    /**
     * @var Collection<int, Ressources>
     */
    #[ORM\OneToMany(targetEntity: Ressources::class, mappedBy: 'cours_id')]
    private Collection $ressource_id;

    #[ORM\ManyToOne(inversedBy: 'cours_id')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Matiere $matiere_id = null;

    public function __construct()
    {
        $this->ressource_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getDurée(): ?\DateTime
    {
        return $this->durée;
    }

    public function setDurée(\DateTime $durée): static
    {
        $this->durée = $durée;

        return $this;
    }

    /**
     * @return Collection<int, Ressources>
     */
    public function getRessourceId(): Collection
    {
        return $this->ressource_id;
    }

    public function addRessourceId(Ressources $ressourceId): static
    {
        if (!$this->ressource_id->contains($ressourceId)) {
            $this->ressource_id->add($ressourceId);
            $ressourceId->setCoursId($this);
        }

        return $this;
    }

    public function removeRessourceId(Ressources $ressourceId): static
    {
        if ($this->ressource_id->removeElement($ressourceId)) {
            // set the owning side to null (unless already changed)
            if ($ressourceId->getCoursId() === $this) {
                $ressourceId->setCoursId(null);
            }
        }

        return $this;
    }

    public function getMatiereId(): ?Matiere
    {
        return $this->matiere_id;
    }

    public function setMatiereId(?Matiere $matiere_id): static
    {
        $this->matiere_id = $matiere_id;

        return $this;
    }
}

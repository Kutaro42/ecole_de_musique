<?php

namespace App\Entity;

use App\Repository\COURSRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: COURSRepository::class)]
class COURS
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DISCIPLINE $id_discipline = null;

    #[ORM\Column(length: 20)]
    private ?string $jour = null;

    #[ORM\Column(length: 20)]
    private ?string $horaire_debut = null;

    #[ORM\Column(length: 20)]
    private ?string $horaire_fin = null;

    /**
     * @var Collection<int, INSCRIPTION>
     */
    #[ORM\OneToMany(targetEntity: INSCRIPTION::class, mappedBy: 'id_cours')]
    private Collection $iNSCRIPTIONs;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PROFESSEUR $id_prof = null;

    public function __construct()
    {
        $this->iNSCRIPTIONs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdDiscipline(): ?DISCIPLINE
    {
        return $this->id_discipline;
    }

    public function setIdDiscipline(?DISCIPLINE $id_discipline): static
    {
        $this->id_discipline = $id_discipline;

        return $this;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): static
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHoraireDebut(): ?string
    {
        return $this->horaire_debut;
    }

    public function setHoraireDebut(string $horaire_debut): static
    {
        $this->horaire_debut = $horaire_debut;

        return $this;
    }

    public function getHoraireFin(): ?string
    {
        return $this->horaire_fin;
    }

    public function setHoraireFin(string $horaire_fin): static
    {
        $this->horaire_fin = $horaire_fin;

        return $this;
    }

    /**
     * @return Collection<int, INSCRIPTION>
     */
    public function getINSCRIPTIONs(): Collection
    {
        return $this->iNSCRIPTIONs;
    }

    public function addINSCRIPTION(INSCRIPTION $iNSCRIPTION): static
    {
        if (!$this->iNSCRIPTIONs->contains($iNSCRIPTION)) {
            $this->iNSCRIPTIONs->add($iNSCRIPTION);
            $iNSCRIPTION->setIdCours($this);
        }

        return $this;
    }

    public function removeINSCRIPTION(INSCRIPTION $iNSCRIPTION): static
    {
        if ($this->iNSCRIPTIONs->removeElement($iNSCRIPTION)) {
            // set the owning side to null (unless already changed)
            if ($iNSCRIPTION->getIdCours() === $this) {
                $iNSCRIPTION->setIdCours(null);
            }
        }

        return $this;
    }

    public function getIdProf(): ?PROFESSEUR
    {
        return $this->id_prof;
    }

    public function setIdProf(?PROFESSEUR $id_prof): static
    {
        $this->id_prof = $id_prof;

        return $this;
    }
}

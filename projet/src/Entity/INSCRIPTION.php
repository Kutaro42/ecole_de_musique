<?php

namespace App\Entity;

use App\Repository\INSCRIPTIONRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: INSCRIPTIONRepository::class)]
class INSCRIPTION
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'id_inscription')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ELEVE $id_eleve = null;

    #[ORM\Column]
    private ?int $coeff_famillial = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $police_assurance = null;

    #[ORM\ManyToOne(inversedBy: 'id_inscription')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FACTURE $id_facture = null;

    #[ORM\ManyToOne]
    private ?RESPONSABLELEGAL $id_responsable_legal_1 = null;

    #[ORM\ManyToOne]
    private ?RESPONSABLELEGAL $id_responsable_legal_2 = null;

    #[ORM\ManyToOne(inversedBy: 'iNSCRIPTIONs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?COURS $id_cours = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEleve(): ?ELEVE
    {
        return $this->id_eleve;
    }

    public function setIdEleve(?ELEVE $id_eleve): static
    {
        $this->id_eleve = $id_eleve;

        return $this;
    }

    public function getCoeffFamillial(): ?int
    {
        return $this->coeff_famillial;
    }

    public function setCoeffFamillial(int $coeff_famillial): static
    {
        $this->coeff_famillial = $coeff_famillial;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPoliceAssurance(): ?string
    {
        return $this->police_assurance;
    }

    public function setPoliceAssurance(string $police_assurance): static
    {
        $this->police_assurance = $police_assurance;

        return $this;
    }

    public function getIdFacture(): ?FACTURE
    {
        return $this->id_facture;
    }

    public function setIdFacture(?FACTURE $id_facture): static
    {
        $this->id_facture = $id_facture;

        return $this;
    }

    /**
     * @return Collection<int, RESPONSABLELEGAL>
     */
    public function getIdResponsableLegal1(): Collection
    {
        return $this->id_responsable_legal_1;
    }

    public function addIdResponsableLegal1(RESPONSABLELEGAL $idResponsableLegal1): static
    {
        if (!$this->id_responsable_legal_1->contains($idResponsableLegal1)) {
            $this->id_responsable_legal_1->add($idResponsableLegal1);
        }

        return $this;
    }

    public function removeIdResponsableLegal1(RESPONSABLELEGAL $idResponsableLegal1): static
    {
        $this->id_responsable_legal_1->removeElement($idResponsableLegal1);

        return $this;
    }

    /**
     * @return Collection<int, RESPONSABLELEGAL>
     */
    public function getIdResponsableLegal2(): Collection
    {
        return $this->id_responsable_legal_2;
    }

    public function addIdResponsableLegal2(RESPONSABLELEGAL $idResponsableLegal2): static
    {
        if (!$this->id_responsable_legal_2->contains($idResponsableLegal2)) {
            $this->id_responsable_legal_2->add($idResponsableLegal2);
        }

        return $this;
    }

    public function removeIdResponsableLegal2(RESPONSABLELEGAL $idResponsableLegal2): static
    {
        $this->id_responsable_legal_2->removeElement($idResponsableLegal2);

        return $this;
    }

    public function setIdResponsableLegal1(?RESPONSABLELEGAL $id_responsable_legal_1): static
    {
        $this->id_responsable_legal_1 = $id_responsable_legal_1;

        return $this;
    }

    public function setIdResponsableLegal2(?RESPONSABLELEGAL $id_responsable_legal_2): static
    {
        $this->id_responsable_legal_2 = $id_responsable_legal_2;

        return $this;
    }

    public function getIdCours(): ?COURS
    {
        return $this->id_cours;
    }

    public function setIdCours(?COURS $id_cours): static
    {
        $this->id_cours = $id_cours;

        return $this;
    }
}

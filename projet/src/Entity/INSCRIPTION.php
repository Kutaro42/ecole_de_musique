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

    #[ORM\ManyToOne(inversedBy: 'id_inscription',cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ELEVE $id_eleve = null;

    #[ORM\Column]
    private ?int $coeff_famillial = null;

    #[ORM\Column(nullable: true)]
    private ?int $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $police_assurance = null;

    #[ORM\ManyToOne(inversedBy: 'id_inscription')]
    #[ORM\JoinColumn(nullable: true)]
    private ?FACTURE $id_facture = null;

    #[ORM\ManyToOne(targetEntity: RESPONSABLELEGAL::class, cascade: ['persist'])]
    private ?RESPONSABLELEGAL $id_responsable_legal_1 = null;

    #[ORM\ManyToOne(targetEntity: RESPONSABLELEGAL::class, cascade: ['persist'])]
    private ?RESPONSABLELEGAL $id_responsable_legal_2 = null;

    // Dans src/Entity/INSCRIPTION.php

    //#[ORM\ManyToOne(targetEntity: COURS::class)]
    //#[ORM\JoinColumn(name: 'id_cours', referencedColumnName: 'id', nullable: false)]
    //private ?COURS $id_cours = null;
    #[Assert\Callback]
    public function validerResponsableMineur(ExecutionContextInterface $context): void
    {
        $eleve = $this->getIdEleve();
        $responsable1 = $this->getIdResponsableLegal1();

        if ($eleve && $eleve->getDateNaissance()) {
            $aujourdhui = new \DateTime();
            $age = $aujourdhui->diff($eleve->getDateNaissance())->y;

            // Si l'élève est mineur, on exige que le Responsable 1 soit rempli
            if ($age < 18) {
                if (!$responsable1 || empty($responsable1->getNom())) {
                    $context->buildViolation("Le nom du responsable légal 1 est obligatoire pour un élève mineur.")
                        ->atPath('id_responsable_legal_1.nom') // Associe l'erreur au champ exact
                        ->addViolation();
                }
                // Vous pouvez faire de même pour le prénom, l'email, etc.
            }
        }
    }

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?DISCIPLINE $id_discipline = null;

    // N'oubliez pas les getters et setters associés :
    public function getIdCours(): ?COURS
    {
        return $this->id_cours;
    }

    public function setIdCours(?COURS $id_cours): static
    {
        $this->id_cours = $id_cours;
        return $this;
    }


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

public function getIdResponsableLegal1(): ?RESPONSABLELEGAL
    {
        return $this->id_responsable_legal_1;
    }

    public function setIdResponsableLegal1(?RESPONSABLELEGAL $id_responsable_legal_1): static
    {
        $this->id_responsable_legal_1 = $id_responsable_legal_1;

        return $this;
    }

    public function getIdResponsableLegal2(): ?RESPONSABLELEGAL
    {
        return $this->id_responsable_legal_2;
    }

    public function setIdResponsableLegal2(?RESPONSABLELEGAL $id_responsable_legal_2): static
    {
        $this->id_responsable_legal_2 = $id_responsable_legal_2;

        return $this;
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



}

<?php

namespace App\Entity;

use App\Repository\FACTURERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FACTURERepository::class)]
class FACTURE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column]
    private ?int $montant = null;

    /**
     * @var Collection<int, INSCRIPTION>
     */
    #[ORM\OneToMany(targetEntity: INSCRIPTION::class, mappedBy: 'id_facture')]
    private Collection $id_inscription;

    public function __construct()
    {
        $this->id_inscription = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): static
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * @return Collection<int, INSCRIPTION>
     */
    public function getIdInscription(): Collection
    {
        return $this->id_inscription;
    }

    public function addIdInscription(INSCRIPTION $idInscription): static
    {
        if (!$this->id_inscription->contains($idInscription)) {
            $this->id_inscription->add($idInscription);
            $idInscription->setIdFacture($this);
        }

        return $this;
    }

    public function removeIdInscription(INSCRIPTION $idInscription): static
    {
        if ($this->id_inscription->removeElement($idInscription)) {
            // set the owning side to null (unless already changed)
            if ($idInscription->getIdFacture() === $this) {
                $idInscription->setIdFacture(null);
            }
        }

        return $this;
    }
}

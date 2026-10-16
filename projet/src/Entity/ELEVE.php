<?php

namespace App\Entity;

use App\Repository\ELEVERepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ELEVERepository::class)]
class ELEVE
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $prenom = null;

    #[ORM\Column(type: 'date', nullable: true)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresse_principale = null;

    #[ORM\Column(nullable: true)]
    private ?int $age = null;


    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel_domicile = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel_portable = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $tel_professionnel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?bool $eleve_majeur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(?\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;
        return $this;
    }

    public function getAdressePrincipale(): ?string
    {
        return $this->adresse_principale;
    }

    public function setAdressePrincipale(?string $adresse_principale): static
    {
        $this->adresse_principale = $adresse_principale;
        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(?int $age): static
    {
        $this->age = $age;
        return $this;
    }


    public function getTelDomicile(): ?string
    {
        return $this->tel_domicile;
    }

    public function setTelDomicile(?string $tel_domicile): static
    {
        $this->tel_domicile = $tel_domicile;
        return $this;
    }

    public function getTelPortable(): ?string
    {
        return $this->tel_portable;
    }

    public function setTelPortable(?string $tel_portable): static
    {
        $this->tel_portable = $tel_portable;
        return $this;
    }

    public function getTelProfessionnel(): ?string
    {
        return $this->tel_professionnel;
    }

    public function setTelProfessionnel(?string $tel_professionnel): static
    {
        $this->tel_professionnel = $tel_professionnel;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;
        return $this;
    }

    public function isEleveMajeur(): ?bool
    {
        return $this->eleve_majeur;
    }

    public function setEleveMajeur(?bool $eleve_majeur): static
    {
        $this->eleve_majeur = $eleve_majeur;
        return $this;
    }
}
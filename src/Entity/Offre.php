<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OffreRepository", repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $employeur;

    /**
     * @ORM\Column(type="date")
     */
    private $date_de_publication;

    /**
     * @ORM\Column(type="string", length=5000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $rythme;

    /**
     * @ORM\Column(type="integer")
     */
    private $salaire;


    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class, inversedBy="offres")
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=NatureContrat::class, inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nature_contrat;

    /**
     * @ORM\ManyToOne(targetEntity=Periode::class, inversedBy="offres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $periode;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getEmployeur(): ?string
    {
        return $this->employeur;
    }

    public function setEmployeur(string $employeur): self
    {
        $this->employeur = $employeur;

        return $this;
    }

    public function getDateDePublication(): ?\DateTimeInterface
    {
        return $this->date_de_publication;
    }

    public function setDateDePublication(\DateTimeInterface $date_de_publication): self
    {
        $this->date_de_publication = $date_de_publication;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getRythme(): ?string
    {
        return $this->rythme;
    }

    public function setRythme(string $rythme): self
    {
        $this->rythme = $rythme;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

public function getNatureContrat(): ?NatureContrat
{
    return $this->nature_contrat;
}

public function setNatureContrat(?NatureContrat $nature_contrat): self
{
    $this->nature_contrat = $nature_contrat;

    return $this;
}

public function getPeriode(): ?Periode
{
    return $this->periode;
}

public function setPeriode(?Periode $periode): self
{
    $this->periode = $periode;

    return $this;
}

}

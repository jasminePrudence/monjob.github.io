<?php

namespace App\Entity;

use App\Repository\VilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VilleRepository::class)
 */
class Ville
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=CodePostal::class, mappedBy="ville")
     */
    private $codePostals;

    /**
     * @ORM\ManyToMany(targetEntity=Adresse::class, mappedBy="ville")
     */
    private $adresses;

    public function __construct()
    {
        $this->codePostals = new ArrayCollection();
        $this->adresses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|CodePostal[]
     */
    public function getCodePostals(): Collection
    {
        return $this->codePostals;
    }

    public function addCodePostal(CodePostal $codePostal): self
    {
        if (!$this->codePostals->contains($codePostal)) {
            $this->codePostals[] = $codePostal;
            $codePostal->setVille($this);
        }

        return $this;
    }

    public function removeCodePostal(CodePostal $codePostal): self
    {
        if ($this->codePostals->removeElement($codePostal)) {
            // set the owning side to null (unless already changed)
            if ($codePostal->getVille() === $this) {
                $codePostal->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresses(): Collection
    {
        return $this->adresses;
    }

    public function addAdress(Adresse $adress): self
    {
        if (!$this->adresses->contains($adress)) {
            $this->adresses[] = $adress;
            $adress->addVille($this);
        }

        return $this;
    }

    public function removeAdress(Adresse $adress): self
    {
        if ($this->adresses->removeElement($adress)) {
            $adress->removeVille($this);
        }

        return $this;
    }

    public function __toString()
    {
        // to show the name of the Category in the select
        return $this->nom;
        // to show the id of the Category in the select
        // return $this->id;
    }
}

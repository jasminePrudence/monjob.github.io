<?php

namespace App\Entity;

use App\Repository\TypeNomRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @ORM\Entity(repositoryClass=TypeNomRepository::class)
 */
class TypeNom
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity=Adresse::class, mappedBy="type", cascade={"persist", "remove"})
     */
    private $adresse;

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

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(Adresse $adresse): self
    {
        // set the owning side of the relation if necessary
        if ($adresse->getType() !== $this) {
            $adresse->setType($this);
        }

        $this->adresse = $adresse;

        return $this;
    }
}

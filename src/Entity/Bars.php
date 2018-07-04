<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BarsRepository")
 */
class Bars
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Alcools;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Diffusions;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Terasse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Photos;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Commentaires;

    /**
     * One Bar has Many Evaluations.
     * @ORM\OneToMany(targetEntity="App\Entity\Evaluations", mappedBy="Bar")
     */

    private $Evaluations;

    /**
     * Bars constructor.
     */
    public function __construct()
    {
        $this->Evaluations = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAlcools(): ?string
    {
        return $this->Alcools;
    }

    public function setAlcools(string $Alcools): self
    {
        $this->Alcools = $Alcools;

        return $this;
    }

    public function getDiffusions(): ?bool
    {
        return $this->Diffusions;
    }

    public function setDiffusions(bool $Diffusions): self
    {
        $this->Diffusions = $Diffusions;

        return $this;
    }

    public function getTerasse(): ?bool
    {
        return $this->Terasse;
    }

    public function setTerasse(bool $Terasse): self
    {
        $this->Terasse = $Terasse;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    public function getPhotos(): ?string
    {
        return $this->Photos;
    }

    public function setPhotos(?string $Photos): self
    {
        $this->Photos = $Photos;

        return $this;
    }

    public function getCommentaires(): ?string
    {
        return $this->Commentaires;
    }

    public function setCommentaires(?string $Commentaires): self
    {
        $this->Commentaires = $Commentaires;

        return $this;
    }

    public function getEvaluations()
    {
        return $this->Evaluations;
    }

    public function setEvaluations(?Evaluations $Evaluations): self
    {
        $this->Evaluations = $Evaluations;

        return $this;
    }
}

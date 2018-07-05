<?php

namespace App\Entity;

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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Notations;

    /**
     * @ORM\OneToMany(targetEntity="Commentary", mappedBy="bar")
     */
    private $Commentaires;

    /**
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     */
    private $user;


    public function setUser($user){
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
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

    public function getNotations(): ?int
    {
        return $this->Notations;
    }

    public function setNotations(?int $Notations): self
    {
        $this->Notations = $Notations;

        return $this;
    }

    public function getCommentaires()
    {
        return $this->Commentaires;
    }

    public function setCommentaires(?string $Commentaires): self
    {
        $this->Commentaires = $Commentaires;

        return $this;
    }
}

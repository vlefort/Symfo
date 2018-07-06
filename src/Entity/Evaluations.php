<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvaluationsRepository")
 */
class Evaluations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Value;

    /**
     * Many Evaluations have One Bar.
     * @ORM\ManyToOne(targetEntity="App\Entity\Bars", inversedBy="Evaluations")
     * @ORM\JoinColumn(name="bar_id", referencedColumnName="id")
     */
    private $Bar;

    /**
     * Many Evaluations have One User.
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="Evaluations")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $User;

    /**
     * Evaluations constructor.
     */
    public function __construct()
    {
    }


    public function getId()
    {
        return $this->id;
    }

    public function getValue(): ?int
    {
        return $this->Value;
    }

    public function setValue(?int $Value): self
    {
        $this->Value = $Value;

        return $this;
    }

    public function getBar(): ?Bars
    {
        return $this->Bar;
    }

    public function setBar(?Bars $Bar): self
    {
        $this->Bar = $Bar;

        return $this;
    }
}

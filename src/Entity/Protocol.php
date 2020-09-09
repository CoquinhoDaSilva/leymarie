<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProtocolRepository")
 */
class Protocol
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(max="5000", maxMessage="Vous avez dépassé le nombre de 5 000 caractères possibles")
     */
    private $wording;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $altpicture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titlepicture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWording(): ?string
    {
        return $this->wording;
    }

    public function setWording(string $wording): self
    {
        $this->wording = $wording;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAltpicture(): ?string
    {
        return $this->altpicture;
    }

    public function setAltpicture(string $altpicture): self
    {
        $this->altpicture = $altpicture;

        return $this;
    }

    public function getTitlepicture(): ?string
    {
        return $this->titlepicture;
    }

    public function setTitlepicture(string $titlepicture): self
    {
        $this->titlepicture = $titlepicture;

        return $this;
    }
}

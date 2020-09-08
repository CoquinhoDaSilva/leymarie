<?php

namespace App\Entity;

use App\Repository\BlocTwoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BlocTwoRepository::class)
 */
class BlocTwo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $altpicture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titlepicture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getAltpicture(): ?string
    {
        return $this->altpicture;
    }

    public function setAltpicture(?string $altpicture): self
    {
        $this->altpicture = $altpicture;

        return $this;
    }

    public function getTitlepicture(): ?string
    {
        return $this->titlepicture;
    }

    public function setTitlepicture(?string $titlepicture): self
    {
        $this->titlepicture = $titlepicture;

        return $this;
    }
}

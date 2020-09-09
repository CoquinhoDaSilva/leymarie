<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Merci de renseigner un titre.")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(max=5000, maxMessage="Vous avez dépassé le nombre de 5 000 caractères possibles.")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255", maxMessage="Vous avez dépassé le nombre de 255 caractères possibles")
     */
    private $subtitles;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commentary", mappedBy="article", orphanRemoval=true)
     */
    private $commentaries;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getLegend(): ?string
    {
        return $this->legend;
    }

    public function setLegend(?string $legend): self
    {
        $this->legend = $legend;

        return $this;
    }

    public function getSubtitles(): ?string
    {
        return $this->subtitles;
    }

    public function setSubtitles(string $subtitles): self
    {
        $this->subtitles = $subtitles;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCommentaries()
    {
        return $this->commentaries;
    }

    /**
     * @param mixed $commentaries
     */
    public function setCommentaries($commentaries): void
    {
        $this->commentaries = $commentaries;
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

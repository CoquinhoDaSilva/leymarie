<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PriceRepository")
 */
class Price
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     * @Assert\Positive
     */
    private $value;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Healthcare", mappedBy="price")
     */
    private $healthcares;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHealthcares()
    {
        return $this->healthcares;
    }

    /**
     * @param mixed $healthcares
     */
    public function setHealthcares($healthcares): void
    {
        $this->healthcares = $healthcares;
    }


}

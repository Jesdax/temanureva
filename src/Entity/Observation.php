<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObservationRepository")
 */
class Observation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $observation_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $adding_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $validation_date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $observer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $validator;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Bird")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bird;

    public function getId()
    {
        return $this->id;
    }

    public function getObservationDate(): ?\DateTimeInterface
    {
        return $this->observation_date;
    }

    public function setObservationDate(\DateTimeInterface $observation_date): self
    {
        $this->observation_date = $observation_date;

        return $this;
    }

    public function getAddingDate(): ?\DateTimeInterface
    {
        return $this->adding_date;
    }

    public function setAddingDate(\DateTimeInterface $adding_date): self
    {
        $this->adding_date = $adding_date;

        return $this;
    }

    public function getValidationDate(): ?\DateTimeInterface
    {
        return $this->validation_date;
    }

    public function setValidationDate(\DateTimeInterface $validation_date): self
    {
        $this->validation_date = $validation_date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getObserver(): ?User
    {
        return $this->observer;
    }

    public function setObserver(?User $observer): self
    {
        $this->observer = $observer;

        return $this;
    }

    public function getValidator(): ?User
    {
        return $this->validator;
    }

    public function setValidator(?User $validator): self
    {
        $this->validator = $validator;

        return $this;
    }

    public function getBird(): ?Bird
    {
        return $this->bird;
    }

    public function setBird(?Bird $bird): self
    {
        $this->bird = $bird;

        return $this;
    }
}

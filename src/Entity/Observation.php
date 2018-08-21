<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    private $observationDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $addingDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $validationDate;

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
     * @Assert\
     */
    private $observer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $validator;

    /**
     * @ORM\JoinColumn(name="bird", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="App\Entity\Bird", cascade={"persist"})
     */
    private $bird;


    public function __construct()
    {
        $this->addingDate = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getObservationDate(): ?\DateTimeInterface
    {
        return $this->observationDate;
    }

    public function setObservationDate(\DateTimeInterface $observationDate): self
    {
        $this->observationDate = $observationDate;

        return $this;
    }

    public function getAddingDate(): ?\DateTimeInterface
    {
        return $this->addingDate;
    }

    public function setAddingDate(\DateTimeInterface $addingDate): self
    {
        $this->addingDate = $addingDate;

        return $this;
    }

    public function getValidationDate(): ?\DateTimeInterface
    {
        return $this->validationDate;
    }

    public function setValidationDate(\DateTimeInterface $validation_date): self
    {
        $this->validationDate = $validationDate;

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

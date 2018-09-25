<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObservationRepository")
 */
class Observation
{
    const NO_VALIDATED = false;
    const VALIDATED = true;

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
     * @ORM\Column(type="datetime", nullable=true)
     *
     */
    private $validationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longitude;

    /**
     * not to be registered in the db
     */
    private $address;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status = self::NO_VALIDATED;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *     mimeTypes = {"image/jpeg", "image/png"},
     *     mimeTypesMessage="Veuillez sélectionner une image .PNG ou .JPEG")bin
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $observer;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     *
     */
    private $validator;
    //@ORM\JoinColumn(nullable=false)


    /**
     * @ORM\JoinColumn(name="bird", referencedColumnName="id")
     * @ORM\ManyToOne(targetEntity="App\Entity\Bird", inversedBy="observations", cascade={"persist"} )
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
        $this->validationDate = $validation_date;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->latitude;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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
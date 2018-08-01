<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DemandRepository")
 */
class Demand
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $certificate;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_certificate;

    /**
     * @ORM\Column(type="date")
     */
    private $certificate_date;

    public function getId()
    {
        return $this->id;
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

    public function getCertificate(): ?string
    {
        return $this->certificate;
    }

    public function setCertificate(string $certificate): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    public function getNbCertificate(): ?int
    {
        return $this->nb_certificate;
    }

    public function setNbCertificate(int $nb_certificate): self
    {
        $this->nb_certificate = $nb_certificate;

        return $this;
    }

    public function getCertificateDate(): ?\DateTimeInterface
    {
        return $this->certificate_date;
    }

    public function setCertificateDate(\DateTimeInterface $certificate_date): self
    {
        $this->certificate_date = $certificate_date;

        return $this;
    }
}

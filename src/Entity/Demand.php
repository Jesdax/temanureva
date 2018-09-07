<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="string", length=255)
     * @Assert\File(
     *     mimeTypes = {"image/jpeg", "image/png", "application/pdf"},
     *     mimeTypesMessage="Veuillez selectionner fichier au format .PDF, .PNG ou .JPEG")
     */
    private $certificate;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_certificate;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    private $certificate_date;

    /**
     * @ORM\Column(type="datetime")
     */
    private $submit_date;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function getId()
    {
        return $this->id;
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

    public function getSubmitDate(): ?\DateTimeInterface
    {
        return $this->submit_date;
    }

    public function setSubmitDate(\DateTimeInterface $submit_date): self
    {
        $this->submit_date = $submit_date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

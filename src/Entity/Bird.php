<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BirdRepository")
 */
class Bird
{
    const SORTING_A_TO_Z = 0;
    const SORTING_Z_TO_A = 1;
    const SORTING_INCREASE_OBSERVATIONS = 2;
    const SORTING_DECREASE_OBSERVATIONS = 3;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reign;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phylum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameClass;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameOrder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $family;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cdName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cdTaxsup;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cdRef;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rank;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lbName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lbAuthor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $validName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vernacularName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vernacularNameEng;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Habitat")
     */
    private $habitat;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     * @
     */
    private $france;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $frenchGuiana;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $martinique;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $guadeloupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $stMartin;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $stBarthelemy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $stPierreMiquelon;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $mayotte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $scatteredIsland;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $reunion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $subAntarcticIsland;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $adelieLand;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $newCaledonia;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $wallisFutuna;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $frenchPolynesia;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\BiogeographicStatus")
     */
    private $clipperton;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var bool
     */
    private $sort = self::SORTING_A_TO_Z;

    /**
     * One Bird has Many Observations.
     * @ORM\OneToMany(targetEntity="App\Entity\Observation", mappedBy="bird")
     */
    private $observations;

    /**
     * Bird constructor.
     */
    public function __construct()
    {
        $this->observations = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getReign(): ?string
    {
        return $this->reign;
    }

    public function setReign(string $reign): self
    {
        $this->reign = $reign;

        return $this;
    }

    public function getPhylum(): ?string
    {
        return $this->phylum;
    }

    public function setPhylum(string $phylum): self
    {
        $this->phylum = $phylum;

        return $this;
    }

    public function getNameClass(): ?string
    {
        return $this->nameClass;
    }

    public function setNameClass(string $nameClass): self
    {
        $this->nameClass = $nameClass;

        return $this;
    }

    public function getNameOrder(): ?string
    {
        return $this->nameOrder;
    }

    public function setNameOrder(string $nameOrder): self
    {
        $this->nameOrder = $nameOrder;

        return $this;
    }

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getCdName(): ?int
    {
        return $this->cdName;
    }

    public function setCdName(int $cdName): self
    {
        $this->cdName = $cdName;

        return $this;
    }

    public function getCdTaxsup(): ?int
    {
        return $this->cdTaxsup;
    }

    public function setCdTaxsup(int $cdTaxsup): self
    {
        $this->cdTaxsup = $cdTaxsup;

        return $this;
    }

    public function getCdRef(): ?int
    {
        return $this->cdRef;
    }

    public function setCdRef(int $cdRef): self
    {
        $this->cdRef = $cdRef;

        return $this;
    }

    public function getRank(): ?string
    {
        return $this->rank;
    }

    public function setRank(string $rank): self
    {
        $this->rank = $rank;

        return $this;
    }

    public function getLbName(): ?string
    {
        return $this->lbName;
    }

    public function setLbName(string $lbName): self
    {
        $this->lbName = $lbName;

        return $this;
    }

    public function getLbAuthor(): ?string
    {
        return $this->lbAuthor;
    }

    public function setLbAuthor(string $lbAuthor): self
    {
        $this->lbAuthor = $lbAuthor;

        return $this;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getValidName(): ?string
    {
        return $this->validName;
    }

    public function setValidName(string $validName): self
    {
        $this->validName = $validName;

        return $this;
    }

    public function getVernacularName(): ?string
    {
        return $this->vernacularName;
    }

    public function setVernacularName(string $vernacularName): self
    {
        $this->vernacularName = $vernacularName;

        return $this;
    }

    public function getVernacularNameEng(): ?string
    {
        return $this->vernacularNameEng;
    }

    public function setVernacularNameEng(string $vernacularNameEng): self
    {
        $this->vernacularNameEng = $vernacularNameEng;

        return $this;
    }

    public function getFrance(): ?string
    {
        return $this->france;
    }

    public function setFrance(string $france): self
    {
        $this->france = $france;

        return $this;
    }

    public function getFrenchGuiana(): ?string
    {
        return $this->frenchGuiana;
    }

    public function setFrenchGuiana(string $frenchGuiana): self
    {
        $this->frenchGuiana = $frenchGuiana;

        return $this;
    }

    public function getMartinique(): ?string
    {
        return $this->martinique;
    }

    public function setMartinique(string $martinique): self
    {
        $this->martinique = $martinique;

        return $this;
    }

    public function getGuadeloupe(): ?string
    {
        return $this->guadeloupe;
    }

    public function setGuadeloupe(string $guadeloupe): self
    {
        $this->guadeloupe = $guadeloupe;

        return $this;
    }

    public function getStMartin(): ?string
    {
        return $this->stMartin;
    }

    public function setStMartin(string $stMartin): self
    {
        $this->stMartin = $stMartin;

        return $this;
    }

    public function getStBarthelemy(): ?string
    {
        return $this->stBarthelemy;
    }

    public function setStBarthelemy(string $stBarthelemy): self
    {
        $this->stBarthelemy = $stBarthelemy;

        return $this;
    }

    public function getStPierreMiquelon(): ?string
    {
        return $this->stPierreMiquelon;
    }

    public function setStPierreMiquelon(string $stPierreMiquelon): self
    {
        $this->stPierreMiquelon = $stPierreMiquelon;

        return $this;
    }

    public function getMayotte(): ?string
    {
        return $this->mayotte;
    }

    public function setMayotte(string $mayotte): self
    {
        $this->mayotte = $mayotte;

        return $this;
    }

    public function getScatteredIsland(): ?string
    {
        return $this->scatteredIsland;
    }

    public function setScatteredIsland(string $scatteredIsland): self
    {
        $this->scatteredIsland = $scatteredIsland;

        return $this;
    }

    public function getReunion(): ?string
    {
        return $this->reunion;
    }

    public function setReunion(string $reunion): self
    {
        $this->reunion = $reunion;

        return $this;
    }

    public function getSubAntarcticIsland(): ?string
    {
        return $this->subAntarcticIsland;
    }

    public function setSubAntarcticIsland(string $subAntarcticIsland): self
    {
        $this->subAntarcticIsland = $subAntarcticIsland;

        return $this;
    }

    public function getAdelieLand(): ?string
    {
        return $this->adelieLand;
    }

    public function setAdelieLand(string $adelieLand): self
    {
        $this->adelieLand = $adelieLand;

        return $this;
    }

    public function getNewCaledonia(): ?string
    {
        return $this->newCaledonia;
    }

    public function setNewCaledonia(string $newCaledonia): self
    {
        $this->newCaledonia = $newCaledonia;

        return $this;
    }

    public function getWallisFutuna(): ?string
    {
        return $this->wallisFutuna;
    }

    public function setWallisFutuna(string $wallisFutuna): self
    {
        $this->wallisFutuna = $wallisFutuna;

        return $this;
    }

    public function getFrenchPolynesia(): ?string
    {
        return $this->frenchPolynesia;
    }

    public function setFrenchPolynesia(string $frenchPolynesia): self
    {
        $this->frenchPolynesia = $frenchPolynesia;

        return $this;
    }

    public function getClipperton(): ?string
    {
        return $this->clipperton;
    }

    public function setClipperton(string $clipperton): self
    {
        $this->clipperton = $clipperton;

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

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitat $habitat): self
    {
        $this->habitat = $habitat;

        return $this;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setSort($sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get observations
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getObservations()
    {
        return $this->observations;
    }

  /*  public function __toString()
    {
        return $this->getVernacularName(). ', '. $this->getLbName();
    }*/
}

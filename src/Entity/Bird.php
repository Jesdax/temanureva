<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BirdRepository")
 */
class Bird
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
    private $reign;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phylum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_class;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_order;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $family;

    /**
     * @ORM\Column(type="integer")
     */
    private $cd_name;

    /**
     * @ORM\Column(type="integer")
     */
    private $cd_taxsup;

    /**
     * @ORM\Column(type="integer")
     */
    private $cd_ref;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rank;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lb_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lb_author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fullname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valid_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vernacular_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vernacular_name_eng;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $france;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $french_guiana;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $martinique;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $guadeloupe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $st_martin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $st_barthelemy;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $st_pierre_miquelon;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mayotte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scattered_island;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reunion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sub_antarctic_island;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adelie_land;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $new_caledonia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $wallis_futuna;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $french_polynesia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $clipperton;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function getId()
    {
        return $this->id;
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
        return $this->name_class;
    }

    public function setNameClass(string $name_class): self
    {
        $this->name_class = $name_class;

        return $this;
    }

    public function getNameOrder(): ?string
    {
        return $this->name_order;
    }

    public function setNameOrder(string $name_order): self
    {
        $this->name_order = $name_order;

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
        return $this->cd_name;
    }

    public function setCdName(int $cd_name): self
    {
        $this->cd_name = $cd_name;

        return $this;
    }

    public function getCdTaxsup(): ?int
    {
        return $this->cd_taxsup;
    }

    public function setCdTaxsup(int $cd_taxsup): self
    {
        $this->cd_taxsup = $cd_taxsup;

        return $this;
    }

    public function getCdRef(): ?int
    {
        return $this->cd_ref;
    }

    public function setCdRef(int $cd_ref): self
    {
        $this->cd_ref = $cd_ref;

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
        return $this->lb_name;
    }

    public function setLbName(string $lb_name): self
    {
        $this->lb_name = $lb_name;

        return $this;
    }

    public function getLbAuthor(): ?string
    {
        return $this->lb_author;
    }

    public function setLbAuthor(string $lb_author): self
    {
        $this->lb_author = $lb_author;

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
        return $this->valid_name;
    }

    public function setValidName(string $valid_name): self
    {
        $this->valid_name = $valid_name;

        return $this;
    }

    public function getVernacularName(): ?string
    {
        return $this->vernacular_name;
    }

    public function setVernacularName(string $vernacular_name): self
    {
        $this->vernacular_name = $vernacular_name;

        return $this;
    }

    public function getVernacularNameEng(): ?string
    {
        return $this->vernacular_name_eng;
    }

    public function setVernacularNameEng(string $vernacular_name_eng): self
    {
        $this->vernacular_name_eng = $vernacular_name_eng;

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
        return $this->french_guiana;
    }

    public function setFrenchGuiana(string $french_guiana): self
    {
        $this->french_guiana = $french_guiana;

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
        return $this->st_martin;
    }

    public function setStMartin(string $st_martin): self
    {
        $this->st_martin = $st_martin;

        return $this;
    }

    public function getStBarthelemy(): ?string
    {
        return $this->st_barthelemy;
    }

    public function setStBarthelemy(string $st_barthelemy): self
    {
        $this->st_barthelemy = $st_barthelemy;

        return $this;
    }

    public function getStPierreMiquelon(): ?string
    {
        return $this->st_pierre_miquelon;
    }

    public function setStPierreMiquelon(string $st_pierre_miquelon): self
    {
        $this->st_pierre_miquelon = $st_pierre_miquelon;

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
        return $this->scattered_island;
    }

    public function setScatteredIsland(string $scattered_island): self
    {
        $this->scattered_island = $scattered_island;

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
        return $this->sub_antarctic_island;
    }

    public function setSubAntarcticIsland(string $sub_antarctic_island): self
    {
        $this->sub_antarctic_island = $sub_antarctic_island;

        return $this;
    }

    public function getAdelieLand(): ?string
    {
        return $this->adelie_land;
    }

    public function setAdelieLand(string $adelie_land): self
    {
        $this->adelie_land = $adelie_land;

        return $this;
    }

    public function getNewCaledonia(): ?string
    {
        return $this->new_caledonia;
    }

    public function setNewCaledonia(string $new_caledonia): self
    {
        $this->new_caledonia = $new_caledonia;

        return $this;
    }

    public function getWallisFutuna(): ?string
    {
        return $this->wallis_futuna;
    }

    public function setWallisFutuna(string $wallis_futuna): self
    {
        $this->wallis_futuna = $wallis_futuna;

        return $this;
    }

    public function getFrenchPolynesia(): ?string
    {
        return $this->french_polynesia;
    }

    public function setFrenchPolynesia(string $french_polynesia): self
    {
        $this->french_polynesia = $french_polynesia;

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

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}

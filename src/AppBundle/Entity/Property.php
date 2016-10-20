<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity
 * @UniqueEntity("reference")
 * @UniqueEntity("inmofactory_reference")
 */
class Property
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=false, unique=true)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="inmofactory_reference", type="string", length=255, nullable=false, unique=true)
     */
    private $inmofactoryReference;

    /**
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Subtype")
     * @ORM\JoinColumn(name="subtype_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $subtype;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_new_construction", type="boolean", nullable=false)
     */
    private $isNewConstruction;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_bank_awarded", type="boolean", nullable=false)
     */
    private $isBankAwarded;

    /**
     * @ORM\ManyToOne(targetEntity="BankAwarded")
     * @ORM\JoinColumn(name="bank_awarded_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $bankAwarded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="activation_date", type="date", nullable=false)
     */
    private $activationDate;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyStatus")
     * @ORM\JoinColumn(name="property_status_id", referencedColumnName="id", nullable=false)
     */
    private $propertyStatus;

    // @TODO demas campos

    /**
     * @var integer
     *
     * @ORM\Column(name="address_id", type="integer", nullable=false)
     */
    private $addressId;

    /**
     * @var integer
     *
     * @ORM\Column(name="property_data_id", type="integer", nullable=false)
     */
    private $propertyDataId;

    /**
     * @var integer
     *
     * @ORM\Column(name="surface", type="integer", nullable=false)
     */
    private $surface;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hide_surface", type="boolean", nullable=false)
     */
    private $hideSurface;

    /**
     * @var integer
     *
     * @ORM\Column(name="currency_id", type="integer", nullable=false)
     */
    private $currencyId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hide_price", type="boolean", nullable=false)
     */
    private $hidePrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="hot_water_id", type="integer", nullable=true)
     */
    private $hotWaterId;

    /**
     * @var integer
     *
     * @ORM\Column(name="construction_year", type="integer", nullable=true)
     */
    private $constructionYear;

    /**
     * @var integer
     *
     * @ORM\Column(name="heating_id", type="integer", nullable=true)
     */
    private $heatingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="energy_certificate_id", type="integer", nullable=true)
     */
    private $energyCertificateId;

    /**
     * @var integer
     *
     * @ORM\Column(name="conservation_id", type="integer", nullable=true)
     */
    private $conservationId;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_toilet", type="integer", nullable=true)
     */
    private $numToilet;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_bath", type="integer", nullable=true)
     */
    private $numBath;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_room", type="integer", nullable=true)
     */
    private $numRoom;

    /**
     * @var integer
     *
     * @ORM\Column(name="orientation_id", type="integer", nullable=true)
     */
    private $orientationId;

    /**
     * @var string
     *
     * @ORM\Column(name="observation", type="text", length=65535, nullable=true)
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="text", length=65535, nullable=true)
     */
    private $shortDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="full_description", type="text", length=65535, nullable=true)
     */
    private $fullDescription;


    /**
     * Property constructor.
     */
    public function __construct()
    {
        $this->isBankAwarded = false;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->id;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Property
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set inmofactoryReference
     *
     * @param string $inmofactoryReference
     * @return Property
     */
    public function setInmofactoryReference($inmofactoryReference)
    {
        $this->inmofactoryReference = $inmofactoryReference;

        return $this;
    }

    /**
     * Get inmofactoryReference
     *
     * @return string 
     */
    public function getInmofactoryReference()
    {
        return $this->inmofactoryReference;
    }

    /**
     * Set isNewConstruction
     *
     * @param boolean $isNewConstruction
     * @return Property
     */
    public function setIsNewConstruction($isNewConstruction)
    {
        $this->isNewConstruction = $isNewConstruction;

        return $this;
    }

    /**
     * Get isNewConstruction
     *
     * @return boolean 
     */
    public function getIsNewConstruction()
    {
        return $this->isNewConstruction;
    }

    /**
     * Set isBankAwarded
     *
     * @param boolean $isBankAwarded
     * @return Property
     */
    public function setIsBankAwarded($isBankAwarded)
    {
        $this->isBankAwarded = $isBankAwarded;

        return $this;
    }

    /**
     * Get isBankAwarded
     *
     * @return boolean 
     */
    public function getIsBankAwarded()
    {
        return $this->isBankAwarded;
    }

    /**
     * Set propertyStatusId
     *
     * @param integer $propertyStatusId
     * @return Property
     */
    public function setPropertyStatusId($propertyStatusId)
    {
        $this->propertyStatusId = $propertyStatusId;

        return $this;
    }

    /**
     * Get propertyStatusId
     *
     * @return integer 
     */
    public function getPropertyStatusId()
    {
        return $this->propertyStatusId;
    }

    /**
     * Set addressId
     *
     * @param integer $addressId
     * @return Property
     */
    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;

        return $this;
    }

    /**
     * Get addressId
     *
     * @return integer 
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * Set propertyDataId
     *
     * @param integer $propertyDataId
     * @return Property
     */
    public function setPropertyDataId($propertyDataId)
    {
        $this->propertyDataId = $propertyDataId;

        return $this;
    }

    /**
     * Get propertyDataId
     *
     * @return integer 
     */
    public function getPropertyDataId()
    {
        return $this->propertyDataId;
    }

    /**
     * Set surface
     *
     * @param integer $surface
     * @return Property
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * Get surface
     *
     * @return integer 
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * Set hideSurface
     *
     * @param boolean $hideSurface
     * @return Property
     */
    public function setHideSurface($hideSurface)
    {
        $this->hideSurface = $hideSurface;

        return $this;
    }

    /**
     * Get hideSurface
     *
     * @return boolean 
     */
    public function getHideSurface()
    {
        return $this->hideSurface;
    }

    /**
     * Set currencyId
     *
     * @param integer $currencyId
     * @return Property
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    /**
     * Get currencyId
     *
     * @return integer 
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * Set hidePrice
     *
     * @param boolean $hidePrice
     * @return Property
     */
    public function setHidePrice($hidePrice)
    {
        $this->hidePrice = $hidePrice;

        return $this;
    }

    /**
     * Get hidePrice
     *
     * @return boolean 
     */
    public function getHidePrice()
    {
        return $this->hidePrice;
    }

    /**
     * Set hotWaterId
     *
     * @param integer $hotWaterId
     * @return Property
     */
    public function setHotWaterId($hotWaterId)
    {
        $this->hotWaterId = $hotWaterId;

        return $this;
    }

    /**
     * Get hotWaterId
     *
     * @return integer 
     */
    public function getHotWaterId()
    {
        return $this->hotWaterId;
    }

    /**
     * Set constructionYear
     *
     * @param integer $constructionYear
     * @return Property
     */
    public function setConstructionYear($constructionYear)
    {
        $this->constructionYear = $constructionYear;

        return $this;
    }

    /**
     * Get constructionYear
     *
     * @return integer 
     */
    public function getConstructionYear()
    {
        return $this->constructionYear;
    }

    /**
     * Set heatingId
     *
     * @param integer $heatingId
     * @return Property
     */
    public function setHeatingId($heatingId)
    {
        $this->heatingId = $heatingId;

        return $this;
    }

    /**
     * Get heatingId
     *
     * @return integer 
     */
    public function getHeatingId()
    {
        return $this->heatingId;
    }

    /**
     * Set energyCertificateId
     *
     * @param integer $energyCertificateId
     * @return Property
     */
    public function setEnergyCertificateId($energyCertificateId)
    {
        $this->energyCertificateId = $energyCertificateId;

        return $this;
    }

    /**
     * Get energyCertificateId
     *
     * @return integer 
     */
    public function getEnergyCertificateId()
    {
        return $this->energyCertificateId;
    }

    /**
     * Set conservationId
     *
     * @param integer $conservationId
     * @return Property
     */
    public function setConservationId($conservationId)
    {
        $this->conservationId = $conservationId;

        return $this;
    }

    /**
     * Get conservationId
     *
     * @return integer 
     */
    public function getConservationId()
    {
        return $this->conservationId;
    }

    /**
     * Set numToilet
     *
     * @param integer $numToilet
     * @return Property
     */
    public function setNumToilet($numToilet)
    {
        $this->numToilet = $numToilet;

        return $this;
    }

    /**
     * Get numToilet
     *
     * @return integer 
     */
    public function getNumToilet()
    {
        return $this->numToilet;
    }

    /**
     * Set numBath
     *
     * @param integer $numBath
     * @return Property
     */
    public function setNumBath($numBath)
    {
        $this->numBath = $numBath;

        return $this;
    }

    /**
     * Get numBath
     *
     * @return integer 
     */
    public function getNumBath()
    {
        return $this->numBath;
    }

    /**
     * Set numRoom
     *
     * @param integer $numRoom
     * @return Property
     */
    public function setNumRoom($numRoom)
    {
        $this->numRoom = $numRoom;

        return $this;
    }

    /**
     * Get numRoom
     *
     * @return integer 
     */
    public function getNumRoom()
    {
        return $this->numRoom;
    }

    /**
     * Set orientationId
     *
     * @param integer $orientationId
     * @return Property
     */
    public function setOrientationId($orientationId)
    {
        $this->orientationId = $orientationId;

        return $this;
    }

    /**
     * Get orientationId
     *
     * @return integer 
     */
    public function getOrientationId()
    {
        return $this->orientationId;
    }

    /**
     * Set observation
     *
     * @param string $observation
     * @return Property
     */
    public function setObservation($observation)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation
     *
     * @return string 
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Property
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set fullDescription
     *
     * @param string $fullDescription
     * @return Property
     */
    public function setFullDescription($fullDescription)
    {
        $this->fullDescription = $fullDescription;

        return $this;
    }

    /**
     * Get fullDescription
     *
     * @return string 
     */
    public function getFullDescription()
    {
        return $this->fullDescription;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\Type $type
     * @return Property
     */
    public function setType(\AppBundle\Entity\Type $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\Type 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set subtype
     *
     * @param \AppBundle\Entity\Subtype $subtype
     * @return Property
     */
    public function setSubtype(\AppBundle\Entity\Subtype $subtype = null)
    {
        $this->subtype = $subtype;

        return $this;
    }

    /**
     * Get subtype
     *
     * @return \AppBundle\Entity\Subtype 
     */
    public function getSubtype()
    {
        return $this->subtype;
    }
}

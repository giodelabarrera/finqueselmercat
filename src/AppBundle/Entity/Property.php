<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity
 * @UniqueEntity("reference")
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
     * @Assert\NotBlank()
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
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
     * @Assert\Date()
     */
    private $activationDate;

    /**
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     * @Assert\NotBlank()
     */
    private $address;

    /**
     * @var integer
     *
     * @ORM\Column(name="surface", type="integer", nullable=false)
     * @Assert\NotBlank()
     */
    private $surface;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hide_surface", type="boolean", nullable=false)
     */
    private $hideSurface;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sale", type="boolean", nullable=false)
     */
    private $sale;

    /**
     * @ORM\OneToOne(targetEntity="ModalitySale", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="modality_sale_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $modalitySale;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rental", type="boolean", nullable=false)
     */
    private $rental;

    /**
     * @ORM\OneToOne(targetEntity="ModalityRental", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="modality_rental_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $modalityRental;

    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank()
     */
    private $currency;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hide_price", type="boolean", nullable=false)
     */
    private $hidePrice;

    /**
     * @ORM\ManyToOne(targetEntity="EnergyType")
     * @ORM\JoinColumn(name="hot_water_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $hotWater;

    /**
     * @var integer
     *
     * @ORM\Column(name="construction_year", type="integer", nullable=true)
     */
    private $constructionYear;

    /**
     * @ORM\ManyToOne(targetEntity="EnergyType")
     * @ORM\JoinColumn(name="heating_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $heating;

    /**
     * @ORM\ManyToOne(targetEntity="EnergyCertificate")
     * @ORM\JoinColumn(name="energy_certificate_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $energyCertificate;

    /**
     * @ORM\ManyToOne(targetEntity="Conservation")
     * @ORM\JoinColumn(name="conservation_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $conservation;

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
     * @ORM\Column(name="num_offices", type="integer", nullable=true)
     */
    private $numOffices;

    /**
     * @ORM\ManyToOne(targetEntity="Orientation")
     * @ORM\JoinColumn(name="orientation_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $orientation;

    /**
     * @var string
     *
     * @ORM\Column(name="building_name", type="string", length=255, nullable=true)
     */
    private $buildingName;

    /**
     * @ORM\ManyToOne(targetEntity="ParkingType")
     * @ORM\JoinColumn(name="parking_type_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $parkingType;

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
     * @ORM\ManyToMany(targetEntity="Extra")
     * @ORM\JoinTable(name="property_extra",
     *      joinColumns={@ORM\JoinColumn(name="property_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="extra_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    private $extras;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     * @Assert\DateTime()
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * Property constructor.
     */
    public function __construct()
    {
        $this->isBankAwarded = false;
        $this->createdAt = new \DateTime();
        $this->activationDate = new \DateTime('today');
        $this->hideSurface = false;
        $this->hidePrice = false;
        $this->modalities = new ArrayCollection();
        $this->extras = new ArrayCollection();
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
     * Set activationDate
     *
     * @param \DateTime $activationDate
     * @return Property
     */
    public function setActivationDate($activationDate)
    {
        $this->activationDate = $activationDate;

        return $this;
    }

    /**
     * Get activationDate
     *
     * @return \DateTime 
     */
    public function getActivationDate()
    {
        return $this->activationDate;
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
     * Set numOffices
     *
     * @param integer $numOffices
     * @return Property
     */
    public function setNumOffices($numOffices)
    {
        $this->numOffices = $numOffices;

        return $this;
    }

    /**
     * Get numOffices
     *
     * @return integer 
     */
    public function getNumOffices()
    {
        return $this->numOffices;
    }

    /**
     * Set buildingName
     *
     * @param string $buildingName
     * @return Property
     */
    public function setBuildingName($buildingName)
    {
        $this->buildingName = $buildingName;

        return $this;
    }

    /**
     * Get buildingName
     *
     * @return string 
     */
    public function getBuildingName()
    {
        return $this->buildingName;
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Property
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Property
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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

    /**
     * Set bankAwarded
     *
     * @param \AppBundle\Entity\BankAwarded $bankAwarded
     * @return Property
     */
    public function setBankAwarded(\AppBundle\Entity\BankAwarded $bankAwarded = null)
    {
        $this->bankAwarded = $bankAwarded;

        return $this;
    }

    /**
     * Get bankAwarded
     *
     * @return \AppBundle\Entity\BankAwarded 
     */
    public function getBankAwarded()
    {
        return $this->bankAwarded;
    }

    /**
     * Set status
     *
     * @param \AppBundle\Entity\Status $status
     * @return Property
     */
    public function setStatus(\AppBundle\Entity\Status $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \AppBundle\Entity\Status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set address
     *
     * @param \AppBundle\Entity\Address $address
     * @return Property
     */
    public function setAddress(\AppBundle\Entity\Address $address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \AppBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set modalitySale
     *
     * @param \AppBundle\Entity\ModalitySale $modalitySale
     * @return Property
     */
    public function setModalitySale(\AppBundle\Entity\ModalitySale $modalitySale = null)
    {
        $this->modalitySale = $modalitySale;

        return $this;
    }

    /**
     * Get modalitySale
     *
     * @return \AppBundle\Entity\ModalitySale 
     */
    public function getModalitySale()
    {
        return $this->modalitySale;
    }

    /**
     * Set modalityRental
     *
     * @param \AppBundle\Entity\ModalityRental $modalityRental
     * @return Property
     */
    public function setModalityRental(\AppBundle\Entity\ModalityRental $modalityRental = null)
    {
        $this->modalityRental = $modalityRental;

        return $this;
    }

    /**
     * Get modalityRental
     *
     * @return \AppBundle\Entity\ModalityRental 
     */
    public function getModalityRental()
    {
        return $this->modalityRental;
    }

    /**
     * Set currency
     *
     * @param \AppBundle\Entity\Currency $currency
     * @return Property
     */
    public function setCurrency(\AppBundle\Entity\Currency $currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \AppBundle\Entity\Currency 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set hotWater
     *
     * @param \AppBundle\Entity\EnergyType $hotWater
     * @return Property
     */
    public function setHotWater(\AppBundle\Entity\EnergyType $hotWater = null)
    {
        $this->hotWater = $hotWater;

        return $this;
    }

    /**
     * Get hotWater
     *
     * @return \AppBundle\Entity\EnergyType 
     */
    public function getHotWater()
    {
        return $this->hotWater;
    }

    /**
     * Set heating
     *
     * @param \AppBundle\Entity\EnergyType $heating
     * @return Property
     */
    public function setHeating(\AppBundle\Entity\EnergyType $heating = null)
    {
        $this->heating = $heating;

        return $this;
    }

    /**
     * Get heating
     *
     * @return \AppBundle\Entity\EnergyType 
     */
    public function getHeating()
    {
        return $this->heating;
    }

    /**
     * Set energyCertificate
     *
     * @param \AppBundle\Entity\EnergyCertificate $energyCertificate
     * @return Property
     */
    public function setEnergyCertificate(\AppBundle\Entity\EnergyCertificate $energyCertificate = null)
    {
        $this->energyCertificate = $energyCertificate;

        return $this;
    }

    /**
     * Get energyCertificate
     *
     * @return \AppBundle\Entity\EnergyCertificate 
     */
    public function getEnergyCertificate()
    {
        return $this->energyCertificate;
    }

    /**
     * Set conservation
     *
     * @param \AppBundle\Entity\Conservation $conservation
     * @return Property
     */
    public function setConservation(\AppBundle\Entity\Conservation $conservation = null)
    {
        $this->conservation = $conservation;

        return $this;
    }

    /**
     * Get conservation
     *
     * @return \AppBundle\Entity\Conservation 
     */
    public function getConservation()
    {
        return $this->conservation;
    }

    /**
     * Set orientation
     *
     * @param \AppBundle\Entity\Orientation $orientation
     * @return Property
     */
    public function setOrientation(\AppBundle\Entity\Orientation $orientation = null)
    {
        $this->orientation = $orientation;

        return $this;
    }

    /**
     * Get orientation
     *
     * @return \AppBundle\Entity\Orientation 
     */
    public function getOrientation()
    {
        return $this->orientation;
    }

    /**
     * Set parkingType
     *
     * @param \AppBundle\Entity\ParkingType $parkingType
     * @return Property
     */
    public function setParkingType(\AppBundle\Entity\ParkingType $parkingType = null)
    {
        $this->parkingType = $parkingType;

        return $this;
    }

    /**
     * Get parkingType
     *
     * @return \AppBundle\Entity\ParkingType 
     */
    public function getParkingType()
    {
        return $this->parkingType;
    }

    /**
     * Add extras
     *
     * @param \AppBundle\Entity\Extra $extras
     * @return Property
     */
    public function addExtra(\AppBundle\Entity\Extra $extras)
    {
        $this->extras[] = $extras;

        return $this;
    }

    /**
     * Remove extras
     *
     * @param \AppBundle\Entity\Extra $extras
     */
    public function removeExtra(\AppBundle\Entity\Extra $extras)
    {
        $this->extras->removeElement($extras);
    }

    /**
     * Get extras
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExtras()
    {
        return $this->extras;
    }

    /**
     * Set sale
     *
     * @param boolean $sale
     * @return Property
     */
    public function setSale($sale)
    {
        $this->sale = $sale;

        return $this;
    }

    /**
     * Get sale
     *
     * @return boolean 
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * Set rental
     *
     * @param boolean $rental
     * @return Property
     */
    public function setRental($rental)
    {
        $this->rental = $rental;

        return $this;
    }

    /**
     * Get rental
     *
     * @return boolean 
     */
    public function getRental()
    {
        return $this->rental;
    }
}

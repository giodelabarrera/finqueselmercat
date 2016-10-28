<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyData
 *
 * @ORM\Table(name="property_data")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PropertyDataRepository")
 */
class PropertyData
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\OneToOne(targetEntity="ModalitySale")
     * @ORM\JoinColumn(name="modality_sale_id", referencedColumnName="id", nullable=true)
     */
    private $modalitySale;

    /**
     * @ORM\OneToOne(targetEntity="ModalityRental")
     * @ORM\JoinColumn(name="modality_rental_id", referencedColumnName="id", nullable=true)
     */
    private $modalityRental;

    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=false)
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
     * PropertyData constructor.
     */
    public function __construct()
    {
        $this->hideSurface = false;
        $this->hidePrice = false;
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
     * Set surface
     *
     * @param integer $surface
     * @return PropertyData
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
     * @return PropertyData
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
     * @return PropertyData
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
     * @return PropertyData
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
     * @return PropertyData
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
     * @return PropertyData
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
     * @return PropertyData
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
     * Set observation
     *
     * @param string $observation
     * @return PropertyData
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
     * Set currency
     *
     * @param \AppBundle\Entity\Currency $currency
     * @return PropertyData
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
     * @param \AppBundle\Entity\HotWater $hotWater
     * @return PropertyData
     */
    public function setHotWater(\AppBundle\Entity\HotWater $hotWater = null)
    {
        $this->hotWater = $hotWater;

        return $this;
    }

    /**
     * Get hotWater
     *
     * @return \AppBundle\Entity\HotWater 
     */
    public function getHotWater()
    {
        return $this->hotWater;
    }

    /**
     * Set heating
     *
     * @param \AppBundle\Entity\Heating $heating
     * @return PropertyData
     */
    public function setHeating(\AppBundle\Entity\Heating $heating = null)
    {
        $this->heating = $heating;

        return $this;
    }

    /**
     * Get heating
     *
     * @return \AppBundle\Entity\Heating 
     */
    public function getHeating()
    {
        return $this->heating;
    }

    /**
     * Set energyCertificate
     *
     * @param \AppBundle\Entity\EnergyCertificate $energyCertificate
     * @return PropertyData
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
     * @return PropertyData
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
     * @return PropertyData
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
     * Set buildingName
     *
     * @param string $buildingName
     * @return PropertyData
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
     * Set modalitySale
     *
     * @param \AppBundle\Entity\ModalitySale $modalitySale
     * @return PropertyData
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
     * @return PropertyData
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
     * Set parkingType
     *
     * @param \AppBundle\Entity\ParkingType $parkingType
     * @return PropertyData
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
}

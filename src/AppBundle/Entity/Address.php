<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity
 */
class Address
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
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="PostalCode")
     * @ORM\JoinColumn(name="postal_code_id", referencedColumnName="id", nullable=false)
     */
    private $postalCode;

    /**
     * @ORM\ManyToOne(targetEntity="Municipality")
     * @ORM\JoinColumn(name="municipality_id", referencedColumnName="id", nullable=false)
     */
    private $municipality;

    /**
     * @ORM\ManyToOne(targetEntity="StreetType")
     * @ORM\JoinColumn(name="street_type_id", referencedColumnName="id", nullable=false)
     */
    private $streetType;

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=50, nullable=true)
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="Floor")
     * @ORM\JoinColumn(name="floor_id", referencedColumnName="id", nullable=false)
     */
    private $floor;

    /**
     * @var string
     *
     * @ORM\Column(name="stair", type="string", length=50, nullable=true)
     */
    private $stair;

    /**
     * @var string
     *
     * @ORM\Column(name="door", type="string", length=50, nullable=true)
     */
    private $door;

    /**
     * @ORM\ManyToOne(targetEntity="ModeShowAddress")
     * @ORM\JoinColumn(name="mode_show_address_id", referencedColumnName="id", nullable=false)
     */
    private $modeShowAddress;

    /**
     * @ORM\ManyToOne(targetEntity="Zone")
     * @ORM\JoinColumn(name="zone_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $zone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * Address constructor.
     */
    public function __construct()
    {
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
     * Set street
     *
     * @param string $street
     * @return Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set stair
     *
     * @param string $stair
     * @return Address
     */
    public function setStair($stair)
    {
        $this->stair = $stair;

        return $this;
    }

    /**
     * Get stair
     *
     * @return string 
     */
    public function getStair()
    {
        return $this->stair;
    }

    /**
     * Set door
     *
     * @param string $door
     * @return Address
     */
    public function setDoor($door)
    {
        $this->door = $door;

        return $this;
    }

    /**
     * Get door
     *
     * @return string 
     */
    public function getDoor()
    {
        return $this->door;
    }

    /**
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return Address
     */
    public function setCountry(\AppBundle\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \AppBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set postalCode
     *
     * @param \AppBundle\Entity\PostalCode $postalCode
     * @return Address
     */
    public function setPostalCode(\AppBundle\Entity\PostalCode $postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return \AppBundle\Entity\PostalCode 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set municipality
     *
     * @param \AppBundle\Entity\Municipality $municipality
     * @return Address
     */
    public function setMunicipality(\AppBundle\Entity\Municipality $municipality)
    {
        $this->municipality = $municipality;

        return $this;
    }

    /**
     * Get municipality
     *
     * @return \AppBundle\Entity\Municipality 
     */
    public function getMunicipality()
    {
        return $this->municipality;
    }

    /**
     * Set streetType
     *
     * @param \AppBundle\Entity\StreetType $streetType
     * @return Address
     */
    public function setStreetType(\AppBundle\Entity\StreetType $streetType)
    {
        $this->streetType = $streetType;

        return $this;
    }

    /**
     * Get streetType
     *
     * @return \AppBundle\Entity\StreetType 
     */
    public function getStreetType()
    {
        return $this->streetType;
    }

    /**
     * Set floor
     *
     * @param \AppBundle\Entity\Floor $floor
     * @return Address
     */
    public function setFloor(\AppBundle\Entity\Floor $floor)
    {
        $this->floor = $floor;

        return $this;
    }

    /**
     * Get floor
     *
     * @return \AppBundle\Entity\Floor 
     */
    public function getFloor()
    {
        return $this->floor;
    }

    /**
     * Set modeShowAddress
     *
     * @param \AppBundle\Entity\ModeShowAddress $modeShowAddress
     * @return Address
     */
    public function setModeShowAddress(\AppBundle\Entity\ModeShowAddress $modeShowAddress)
    {
        $this->modeShowAddress = $modeShowAddress;

        return $this;
    }

    /**
     * Get modeShowAddress
     *
     * @return \AppBundle\Entity\ModeShowAddress 
     */
    public function getModeShowAddress()
    {
        return $this->modeShowAddress;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Address
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
     * @return Address
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
     * Set zone
     *
     * @param \AppBundle\Entity\Zone $zone
     * @return Address
     */
    public function setZone(\AppBundle\Entity\Zone $zone = null)
    {
        $this->zone = $zone;

        return $this;
    }

    /**
     * Get zone
     *
     * @return \AppBundle\Entity\Zone 
     */
    public function getZone()
    {
        return $this->zone;
    }
}

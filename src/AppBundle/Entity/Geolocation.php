<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Geolocation
 *
 * @ORM\Table(
 *     name="geolocation",
 *     uniqueConstraints={@ORM\UniqueConstraint(columns={"country_id", "province_id", "municipality_id", "postal_code_id"})}
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GeolocationRepository")
 * @UniqueEntity({"country", "province", "municipality", "postalCode"})
 */
class Geolocation
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
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="Province")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $province;

    /**
     * @ORM\ManyToOne(targetEntity="Municipality")
     * @ORM\JoinColumn(name="municipality_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $municipality;

    /**
     * @ORM\ManyToOne(targetEntity="PostalCode")
     * @ORM\JoinColumn(name="postal_code_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255, nullable=true)
     */
    private $longitude;

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
     * Geolocation constructor.
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
     * Set latitude
     *
     * @param string $latitude
     * @return Geolocation
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Geolocation
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Geolocation
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
     * @return Geolocation
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
     * Set country
     *
     * @param \AppBundle\Entity\Country $country
     * @return Geolocation
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
     * Set province
     *
     * @param \AppBundle\Entity\Province $province
     * @return Geolocation
     */
    public function setProvince(\AppBundle\Entity\Province $province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return \AppBundle\Entity\Province 
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * Set municipality
     *
     * @param \AppBundle\Entity\Municipality $municipality
     * @return Geolocation
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
     * Set postalCode
     *
     * @param \AppBundle\Entity\PostalCode $postalCode
     * @return Geolocation
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
}

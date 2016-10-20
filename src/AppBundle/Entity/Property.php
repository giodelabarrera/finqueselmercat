<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 *
 * @ORM\Table(name="property")
 * @ORM\Entity
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
     * @ORM\Column(name="reference", type="string", length=255, nullable=false)
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
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
     * @var \DateTime
     *
     * @ORM\Column(name="acquisition_date", type="date", nullable=false)
     */
    private $acquisitionDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="property_status_id", type="integer", nullable=false)
     */
    private $propertyStatusId;

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




}

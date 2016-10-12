<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PropertyData
 *
 * @ORM\Table(name="property_data")
 * @ORM\Entity
 */
class PropertyData
{
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

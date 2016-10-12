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
     * @ORM\Column(name="cp", type="integer", nullable=false)
     */
    private $cp;

    /**
     * @var integer
     *
     * @ORM\Column(name="city_id", type="integer", nullable=false)
     */
    private $cityId;

    /**
     * @var integer
     *
     * @ORM\Column(name="street_type_id", type="integer", nullable=false)
     */
    private $streetTypeId;

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
     * @var integer
     *
     * @ORM\Column(name="floor_id", type="integer", nullable=true)
     */
    private $floorId;

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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

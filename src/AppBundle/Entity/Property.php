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
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255, nullable=false)
     */
    private $reference;

    /**
     * @var integer
     *
     * @ORM\Column(name="type_id", type="integer", nullable=false)
     */
    private $typeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="subtype_id", type="integer", nullable=false)
     */
    private $subtypeId;

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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

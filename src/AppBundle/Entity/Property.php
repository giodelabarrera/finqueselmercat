<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

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
     */
    private $reference;

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
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id", nullable=false)
     */
    private $status;

    /**
     * @ORM\OneToOne(targetEntity="StatusReserved", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="status_reserved_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $statusReserved;

    /**
     * @ORM\OneToOne(targetEntity="StatusNotAvailable", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="status_not_available_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $statusNotAvailable;

    /**
     * @ORM\OneToOne(targetEntity="Address", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $address;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
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
     * Set statusReserved
     *
     * @param \AppBundle\Entity\StatusReserved $statusReserved
     * @return Property
     */
    public function setStatusReserved(\AppBundle\Entity\StatusReserved $statusReserved = null)
    {
        $this->statusReserved = $statusReserved;

        return $this;
    }

    /**
     * Get statusReserved
     *
     * @return \AppBundle\Entity\StatusReserved 
     */
    public function getStatusReserved()
    {
        return $this->statusReserved;
    }

    /**
     * Set statusNotAvailable
     *
     * @param \AppBundle\Entity\StatusNotAvailable $statusNotAvailable
     * @return Property
     */
    public function setStatusNotAvailable(\AppBundle\Entity\StatusNotAvailable $statusNotAvailable = null)
    {
        $this->statusNotAvailable = $statusNotAvailable;

        return $this;
    }

    /**
     * Get statusNotAvailable
     *
     * @return \AppBundle\Entity\StatusNotAvailable 
     */
    public function getStatusNotAvailable()
    {
        return $this->statusNotAvailable;
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
}

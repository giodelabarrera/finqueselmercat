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
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id", nullable=false)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="PropertyData")
     * @ORM\JoinColumn(name="property_data_id", referencedColumnName="id", nullable=false)
     */
    private $propertyData;

    /**
     * @ORM\OneToOne(targetEntity="PropertyDescription")
     * @ORM\JoinColumn(name="property_description_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $propertyDescription;

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
     * Set propertyData
     *
     * @param \AppBundle\Entity\PropertyData $propertyData
     * @return Property
     */
    public function setPropertyData(\AppBundle\Entity\PropertyData $propertyData)
    {
        $this->propertyData = $propertyData;

        return $this;
    }

    /**
     * Get propertyData
     *
     * @return \AppBundle\Entity\PropertyData 
     */
    public function getPropertyData()
    {
        return $this->propertyData;
    }

    /**
     * Set propertyDescription
     *
     * @param \AppBundle\Entity\PropertyDescription $propertyDescription
     * @return Property
     */
    public function setPropertyDescription(\AppBundle\Entity\PropertyDescription $propertyDescription = null)
    {
        $this->propertyDescription = $propertyDescription;

        return $this;
    }

    /**
     * Get propertyDescription
     *
     * @return \AppBundle\Entity\PropertyDescription 
     */
    public function getPropertyDescription()
    {
        return $this->propertyDescription;
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
}

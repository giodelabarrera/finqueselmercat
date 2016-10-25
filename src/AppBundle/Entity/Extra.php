<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Extra
 *
 * @ORM\Table(name="extra")
 * @ORM\Entity
 */
class Extra
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="ExtraType")
     * @ORM\JoinColumn(name="extra_type_id", referencedColumnName="id", nullable=false)
     */
    private $extraType;


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
     * Extra constructor.
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
        return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return Extra
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Extra
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
     * @return Extra
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
     * @return Extra
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
     * Set extraType
     *
     * @param \AppBundle\Entity\ExtraType $extraType
     * @return Extra
     */
    public function setExtraType(\AppBundle\Entity\ExtraType $extraType)
    {
        $this->extraType = $extraType;

        return $this;
    }

    /**
     * Get extraType
     *
     * @return \AppBundle\Entity\ExtraType 
     */
    public function getExtraType()
    {
        return $this->extraType;
    }
}

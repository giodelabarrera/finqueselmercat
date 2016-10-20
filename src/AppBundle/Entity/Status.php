<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * PropertyStatus
 *
 * @ORM\Table(name="status")
 * @ORM\Entity
 * @UniqueEntity("slug")
 */
class Status
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
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=false, unique=true)
     */
    private $slug;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_order", type="integer", nullable=true)
     */
    private $numOrder;

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
     * @ORM\ManyToOne(targetEntity="StatusReserved")
     * @ORM\JoinColumn(name="status_reserved_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $statusReserved;

    /**
     * @ORM\ManyToOne(targetEntity="StatusNotAvailable")
     * @ORM\JoinColumn(name="status_not_available_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $statusNotAvailable;

    /**
     * PropertyStatus constructor.
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
     * @return Status
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
     * Set slug
     *
     * @param string $slug
     * @return Status
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set numOrder
     *
     * @param integer $numOrder
     * @return Status
     */
    public function setNumOrder($numOrder)
    {
        $this->numOrder = $numOrder;

        return $this;
    }

    /**
     * Get numOrder
     *
     * @return integer 
     */
    public function getNumOrder()
    {
        return $this->numOrder;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Status
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
     * @return Status
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
     * Set statusReserved
     *
     * @param \AppBundle\Entity\StatusReserved $statusReserved
     * @return Status
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
     * @return Status
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
}

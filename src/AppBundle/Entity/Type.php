<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity
 * @UniqueEntity("slug")
 */
class Type
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
     * @ORM\ManyToMany(targetEntity="Subtype")
     * @ORM\JoinTable(name="type_subtype",
     *      joinColumns={@ORM\JoinColumn(name="type_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="subtype_id", referencedColumnName="id", onDelete="CASCADE")}
     *      )
     */
    private $subtypes;

    /**
     * Type constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->subtypes = new ArrayCollection();
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
     * @return Type
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
     * @return Type
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Type
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
     * @return Type
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
     * Set numOrder
     *
     * @param integer $numOrder
     * @return Type
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
     * Add subtypes
     *
     * @param \AppBundle\Entity\Subtype $subtypes
     * @return Type
     */
    public function addSubtype(\AppBundle\Entity\Subtype $subtypes)
    {
        $this->subtypes[] = $subtypes;

        return $this;
    }

    /**
     * Remove subtypes
     *
     * @param \AppBundle\Entity\Subtype $subtypes
     */
    public function removeSubtype(\AppBundle\Entity\Subtype $subtypes)
    {
        $this->subtypes->removeElement($subtypes);
    }

    /**
     * Get subtypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubtypes()
    {
        return $this->subtypes;
    }
}

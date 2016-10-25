<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusNotAvailable
 *
 * @ORM\Table(name="status_not_available")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatusNotAvailableRepository")
 */
class StatusNotAvailable
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_not_available", type="date")
     */
    private $dateNotAvailable;

    /**
     * @ORM\ManyToOne(targetEntity="MotiveNotAvailable")
     * @ORM\JoinColumn(name="motive_not_available_id", referencedColumnName="id", nullable=false)
     */
    private $motiveNotAvailable;

    /**
     * @var string
     *
     * @ORM\Column(name="amount_close", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $amountClose;

    /**
     * @var string
     *
     * @ORM\Column(name="client_close", type="string", length=255, nullable=true)
     */
    private $clientClose;

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
     * StatusNotAvailable constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
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
     * Set dateNotAvailable
     *
     * @param \DateTime $dateNotAvailable
     * @return StatusNotAvailable
     */
    public function setDateNotAvailable($dateNotAvailable)
    {
        $this->dateNotAvailable = $dateNotAvailable;

        return $this;
    }

    /**
     * Get dateNotAvailable
     *
     * @return \DateTime 
     */
    public function getDateNotAvailable()
    {
        return $this->dateNotAvailable;
    }

    /**
     * Set motiveNotAvailable
     *
     * @param \AppBundle\Entity\MotiveNotAvailable $motiveNotAvailable
     * @return StatusNotAvailable
     */
    public function setMotiveNotAvailable(\AppBundle\Entity\MotiveNotAvailable $motiveNotAvailable)
    {
        $this->motiveNotAvailable = $motiveNotAvailable;

        return $this;
    }

    /**
     * Get motiveNotAvailable
     *
     * @return \AppBundle\Entity\MotiveNotAvailable 
     */
    public function getMotiveNotAvailable()
    {
        return $this->motiveNotAvailable;
    }

    /**
     * Set amountClose
     *
     * @param string $amountClose
     * @return StatusNotAvailable
     */
    public function setAmountClose($amountClose)
    {
        $this->amountClose = $amountClose;

        return $this;
    }

    /**
     * Get amountClose
     *
     * @return string 
     */
    public function getAmountClose()
    {
        return $this->amountClose;
    }

    /**
     * Set clientClose
     *
     * @param string $clientClose
     * @return StatusNotAvailable
     */
    public function setClientClose($clientClose)
    {
        $this->clientClose = $clientClose;

        return $this;
    }

    /**
     * Get clientClose
     *
     * @return string 
     */
    public function getClientClose()
    {
        return $this->clientClose;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return StatusNotAvailable
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
     * @return StatusNotAvailable
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
}

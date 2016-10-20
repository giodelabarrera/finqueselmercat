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
}

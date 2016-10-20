<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotiveNotAvailable
 *
 * @ORM\Table(name="motive_not_available")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MotiveNotAvailableRepository")
 */
class MotiveNotAvailable
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

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
     * @return MotiveNotAvailable
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
     * @return MotiveNotAvailable
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
     * Set amountClose
     *
     * @param string $amountClose
     * @return MotiveNotAvailable
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
     * @return MotiveNotAvailable
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
}

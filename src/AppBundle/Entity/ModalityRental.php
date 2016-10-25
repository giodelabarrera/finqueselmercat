<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ModalityRental
 *
 * @ORM\Table(name="modality_rental")
 * @ORM\Entity
 */
class ModalityRental
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
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="price_meter_square", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $priceMeterSquare;

    /**
     * @var boolean
     *
     * @ORM\Column(name="option_purchase", type="boolean", nullable=false)
     */
    private $optionPurchase;

    /**
     * @var string
     *
     * @ORM\Column(name="purchase_final_price", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $purchaseFinalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="purchase_conditions", type="text", length=65535, nullable=true)
     */
    private $purchaseConditions;

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
     * ModalityRental constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->optionPurchase = false;
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
     * Set price
     *
     * @param string $price
     * @return ModalityRental
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set priceMeterSquare
     *
     * @param string $priceMeterSquare
     * @return ModalityRental
     */
    public function setPriceMeterSquare($priceMeterSquare)
    {
        $this->priceMeterSquare = $priceMeterSquare;

        return $this;
    }

    /**
     * Get priceMeterSquare
     *
     * @return string 
     */
    public function getPriceMeterSquare()
    {
        return $this->priceMeterSquare;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return ModalityRental
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
     * @return ModalityRental
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

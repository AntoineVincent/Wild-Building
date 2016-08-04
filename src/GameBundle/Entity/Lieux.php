<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieux
 *
 * @ORM\Table(name="lieux")
 * @ORM\Entity(repositoryClass="GameBundle\Repository\LieuxRepository")
 */
class Lieux
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="lattitude", type="float", nullable=true)
     */
    private $lattitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", nullable=true)
     */
    private $longitude;

    /**
     * @var int
     *
     * @ORM\Column(name="difficult", type="integer", nullable=true)
     */
    private $difficult;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255, nullable=true)
     */
    private $file;


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
     * @return Lieux
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
     * Set lattitude
     *
     * @param float $lattitude
     * @return Lieux
     */
    public function setLattitude($lattitude)
    {
        $this->lattitude = $lattitude;

        return $this;
    }

    /**
     * Get lattitude
     *
     * @return float 
     */
    public function getLattitude()
    {
        return $this->lattitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Lieux
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set difficult
     *
     * @param integer $difficult
     * @return Lieux
     */
    public function setDifficult($difficult)
    {
        $this->difficult = $difficult;

        return $this;
    }

    /**
     * Get difficult
     *
     * @return integer 
     */
    public function getDifficult()
    {
        return $this->difficult;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return Lieux
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }
}

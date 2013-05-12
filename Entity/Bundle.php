<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\DynamicConnectionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sip_bundle")
 */
class Bundle
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="text", name="app_kernel")
     */
    protected $appKernel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $config;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $routing;

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
     * @return Bundle
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
     * Set description
     *
     * @param string $description
     * @return Bundle
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set appKernel
     *
     * @param string $appKernel
     * @return Bundle
     */
    public function setAppKernel($appKernel)
    {
        $this->appKernel = $appKernel;

        return $this;
    }

    /**
     * Get appKernel
     *
     * @return string 
     */
    public function getAppKernel()
    {
        return $this->appKernel;
    }

    /**
     * Set config
     *
     * @param string $config
     * @return Bundle
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * Get config
     *
     * @return string 
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Set routing
     *
     * @param string $routing
     * @return Bundle
     */
    public function setRouting($routing)
    {
        $this->routing = $routing;

        return $this;
    }

    /**
     * Get routing
     *
     * @return string 
     */
    public function getRouting()
    {
        return $this->routing;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getName();
    }
}

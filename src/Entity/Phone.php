<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 */
class Phone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $buildNumber;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modelName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $operatingSystem;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $serialNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $version;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBuildNumber(): ?int
    {
        return $this->buildNumber;
    }

    public function setBuildNumber(int $buildNumber): self
    {
        $this->buildNumber = $buildNumber;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getModelName(): ?string
    {
        return $this->modelName;
    }

    public function setModelName(string $modelName): self
    {
        $this->modelName = $modelName;

        return $this;
    }

    public function getOperatingSystem(): ?string
    {
        return $this->operatingSystem;
    }

    public function setOperatingSystem(string $operatingSystem): self
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }

    public function getSerialNumber(): ?string
    {
        return $this->serialNumber;
    }

    public function setSerialNumber(string $serialNumber): self
    {
        $this->serialNumber = $serialNumber;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }
}

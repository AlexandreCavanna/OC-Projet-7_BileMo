<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;

/**
 * @ORM\Entity(repositoryClass=PhoneRepository::class)
 */
class Phone
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @OA\Property(description="The unique identifier of the smartphone.")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @OA\Property(description="The build number identifier of the smartphone.")
     */
    private int $buildNumber;

    /**
     * @ORM\Column(type="string", length=50)
     * @OA\Property(description="Company who made the smartphone.", maxLength=50)
     */
    private string $manufacturer;

    /**
     * @ORM\Column(type="string", length=255)
     * @OA\Property(description="Model name of the smartphone.", maxLength=255)
     */
    private string $modelName;

    /**
     * @ORM\Column(type="string", length=255)
     * @OA\Property(description="Operating system of the smartphone.", maxLength=255)
     */
    private string $operatingSystem;

    /**
     * @ORM\Column(type="string", length=255)
     * @OA\Property(description="Serial number of the smartphone.", maxLength=255)
     */
    private string $serialNumber;

    /**
     * @ORM\Column(type="integer")
     * @OA\Property(description="Version of the smartphone.")
     */
    private int $version;

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

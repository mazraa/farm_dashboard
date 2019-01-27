<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DcEnvironmentRepository")
 */
class DcEnvironment
{
    /**
     * @var int
     *
     * @ORM\Column(name="envID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $envID;

    /**
     * @ORM\Column(name="envTemp", type="string", length=10, nullable=true)
     */
    private $envTemp;

    /**
     * @ORM\Column(name="envHumidity", type="string", length=10, nullable=true)
     */
    private $envHumidity;

    /**
     * @ORM\Column(name="envLight",type="string", length=10, nullable=true)
     */
    private $envLight;

    /**
     * @ORM\Column(name="envLastUpdate",type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $envLastUpdate;


    public function getEnvID(): ?int
    {
        return $this->envID;
    }

    // public function setEnvID(int $envID): self
    // {
    //     $this->envID = $envID;

    //     return $this;
    // }

    public function getEnvTemp(): ?string
    {
        return $this->envTemp;
    }

    public function setEnvTemp(?string $envTemp): self
    {
        $this->envTemp = $envTemp;

        return $this;
    }

    public function getEnvHumidity(): ?string
    {
        return $this->envHumidity;
    }

    public function setEnvHumidity(?string $envHumidity): self
    {
        $this->envHumidity = $envHumidity;

        return $this;
    }

    public function getEnvLight(): ?string
    {
        return $this->envLight;
    }

    public function setEnvLight(?string $envLight): self
    {
        $this->envLight = $envLight;

        return $this;
    }

    public function getEnvLastUpdate(): ?\DateTimeInterface
    {
        return $this->envLastUpdate;
    }

    // public function setEnvLastUpdate(?\DateTimeInterface $envLastUpdate): self
    // {
    //     $this->envLastUpdate = $envLastUpdate;

    //     return $this;
    // }
}

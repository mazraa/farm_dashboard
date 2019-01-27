<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DcNetworkRepository")
 */
class DcNetwork
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="ID", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true, precision=10, scale=2)
     */
    private $wan_up;

    /**
     * @ORM\Column(type="float", nullable=true, precision=10, scale=2)
     */
    private $wan_down;

    /**
     * @ORM\Column(type="float", nullable=true, precision=10, scale=2)
     */
    private $lan_throughput;

    /**
     * @ORM\Column(name="LastUpdate", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $LastUpdate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWanUp(): ?float
    {
        return $this->wan_up;
    }

    public function setWanUp(?float $wan_up): self
    {
        $this->wan_up = $wan_up;

        return $this;
    }

    public function getWanDown(): ?float
    {
        return $this->wan_down;
    }

    public function setWanDown(?float $wan_down): self
    {
        $this->wan_down = $wan_down;

        return $this;
    }

    public function getLanThroughput(): ?float
    {
        return $this->lan_throughput;
    }

    public function setLanThroughput(?float $lan_throughput): self
    {
        $this->lan_throughput = $lan_throughput;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->LastUpdate;
    }

    // public function setLastUpdate(\DateTimeInterface $LastUpdate): self
    // {
    //     $this->LastUpdate = $LastUpdate;

    //     return $this;
    // }
}

<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity(repositoryClass="App\Repository\DcThresholdsRepository")
 */
class DcThresholds
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="ID", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $temp_min;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $temp_max;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $temp_lastupdate;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $humidity_min;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $humidity_max;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $humidity_lastupdate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $farm_node_count;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $grid_node_count;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $grid_run_update;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $lan_min_throughput;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $wan_min_down;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $wan_min_up;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $network_lastupdate;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTempMin(): ?float
    {
        return $this->temp_min;
    }

    public function setTempMin(?float $temp_min): self
    {
        $this->temp_min = $temp_min;

        return $this;
    }

    public function getTempMax(): ?float
    {
        return $this->temp_max;
    }

    public function setTempMax(?float $temp_max): self
    {
        $this->temp_max = $temp_max;

        return $this;
    }

    public function getTempLastupdate(): ?\DateTimeInterface
    {
        return $this->temp_lastupdate;
    }

    public function setTempLastupdate(?\DateTimeInterface $temp_lastupdate): self
    {
        $this->temp_lastupdate = $temp_lastupdate;

        return $this;
    }

    public function getHumidityMin(): ?float
    {
        return $this->humidity_min;
    }

    public function setHumidityMin(?float $humidity_min): self
    {
        $this->humidity_min = $humidity_min;

        return $this;
    }

    public function getHumidityMax(): ?float
    {
        return $this->humidity_max;
    }

    public function setHumidityMax(?float $humidity_max): self
    {
        $this->humidity_max = $humidity_max;

        return $this;
    }

    public function getHumidityLastupdate(): ?\DateTimeInterface
    {
        return $this->humidity_lastupdate;
    }

    public function setHumidityLastupdate(?\DateTimeInterface $humidity_lastupdate): self
    {
        $this->humidity_lastupdate = $humidity_lastupdate;

        return $this;
    }

    public function getFarmNodeCount(): ?int
    {
        return $this->farm_node_count;
    }

    public function setFarmNodeCount(?int $farm_node_count): self
    {
        $this->farm_node_count = $farm_node_count;

        return $this;
    }

    public function getGridNodeCount(): ?int
    {
        return $this->grid_node_count;
    }

    public function setGridNodeCount(?int $grid_node_count): self
    {
        $this->grid_node_count = $grid_node_count;

        return $this;
    }

    public function getGridRunUpdate(): ?\DateTimeInterface
    {
        return $this->grid_run_update;
    }

    public function setGridRunUpdate(?\DateTimeInterface $grid_run_update): self
    {
        $this->grid_run_update = $grid_run_update;

        return $this;
    }

    public function getLanMinThroughput(): ?float
    {
        return $this->lan_min_throughput;
    }

    public function setLanMinThroughput(?float $lan_min_throughput): self
    {
        $this->lan_min_throughput = $lan_min_throughput;

        return $this;
    }

    public function getWanMinDown(): ?float
    {
        return $this->wan_min_down;
    }

    public function setWanMinDown(?float $wan_min_down): self
    {
        $this->wan_min_down = $wan_min_down;

        return $this;
    }

    public function getWanMinUp(): ?float
    {
        return $this->wan_min_up;
    }

    public function setWanMinUp(?float $wan_min_up): self
    {
        $this->wan_min_up = $wan_min_up;

        return $this;
    }

    public function getNetworkLastupdate(): ?\DateTimeInterface
    {
        return $this->network_lastupdate;
    }

    public function setNetworkLastupdate(?\DateTimeInterface $network_lastupdate): self
    {
        $this->network_lastupdate = $network_lastupdate;

        return $this;
    }
}

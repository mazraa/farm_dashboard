<?php

namespace App\Entity;

// use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @ORM\Entity(repositoryClass="App\Repository\DcCapacityRepository")
 */
class DcCapacity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="ID", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cru_total;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mru_total;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hru_total;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sru_total;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cru_free;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mru_free;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $hru_free;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sru_free;

    /**
     * @ORM\Column(name="last_update",type="datetime", nullable=false)
     */
    private $LastUpdate;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $node_id;

 
    public function getId(): ?int
    {
        return $this->id;
    }

    // public function setId(?int $id): self
    // {
    //     $this->id = $id;

    //     return $this;
    // }

    public function getCruTotal(): ?int
    {
        return $this->cru_total;
    }

    public function setCruTotal(?int $cru_total): self
    {
        $this->cru_total = $cru_total;

        return $this;
    }

    public function getMruTotal(): ?int
    {
        return $this->mru_total;
    }

    public function setMruTotal(?int $mru_total): self
    {
        $this->mru_total = $mru_total;

        return $this;
    }

    public function getHruTotal(): ?int
    {
        return $this->hru_total;
    }

    public function setHruTotal(?int $hru_total): self
    {
        $this->hru_total = $hru_total;

        return $this;
    }

    public function getSruTotal(): ?int
    {
        return $this->sru_total;
    }

    public function setSruTotal(?int $sru_total): self
    {
        $this->sru_total = $sru_total;

        return $this;
    }

    public function getCruFree(): ?int
    {
        return $this->cru_free;
    }

    public function setCruFree(?int $cru_free): self
    {
        $this->cru_free = $cru_free;

        return $this;
    }

    public function getMruFree(): ?int
    {
        return $this->mru_free;
    }

    public function setMruFree(?int $mru_free): self
    {
        $this->mru_free = $mru_free;

        return $this;
    }

    public function getHruFree(): ?int
    {
        return $this->hru_free;
    }

    public function setHruFree(?int $hru_free): self
    {
        $this->hru_free = $hru_free;

        return $this;
    }

    public function getSruFree(): ?int
    {
        return $this->sru_free;
    }

    public function setSruFree(?int $sru_free): self
    {
        $this->sru_free = $sru_free;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->LastUpdate;
    }

    public function setLastUpdate(?\DateTimeInterface $LastUpdate): self
    {
        $this->LastUpdate = $LastUpdate;

        return $this;
    }

    public function getNodeId(): ?string
    {
        return $this->node_id;
    }

    public function setNodeId(?string $node_id): self
    {
        $this->node_id = $node_id;

        return $this;
    }

 
}

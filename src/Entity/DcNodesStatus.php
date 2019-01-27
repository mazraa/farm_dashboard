<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DcNodesStatusRepository")
 */
class DcNodesStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(name="ID", type="integer", nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nodes_online;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nodes_offline;

    /**
     * @ORM\Column(name="LastUpdate", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $LastUpdate;

    public function getId(): ?int
    {
        return $this->id;
    }
    // public function setId(int $id): self
    // {
    //     $this->id = $id;

    //     return $this;
    // }
    public function getNodesOnline(): ?int
    {
        return $this->nodes_online;
    }

    public function setNodesOnline(?int $nodes_online): self
    {
        $this->nodes_online = $nodes_online;

        return $this;
    }

    public function getNodesOffline(): ?int
    {
        return $this->nodes_offline;
    }

    public function setNodesOffline(?int $nodes_offline): self
    {
        $this->nodes_offline = $nodes_offline;

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

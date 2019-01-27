<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * DcProfile
 *
 * @ORM\Table(name="dc_profile")
 * @ORM\Entity(repositoryClass="App\Repository\DcProfileRepository")
 */
class DcProfile implements UserInterface, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="farm_name", type="string", length=100, nullable=true)
     */
    private $farmName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="farm_user", type="string", length=50, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="farm_pass", type="string", length=200, nullable=true)
     */
    private $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_checked", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastChecked;


    public function getId()
    {
        return $this->id;
    }

    public function getfarmName(): ?string
    {
        return $this->farmName;
    }
    public function setfarmName(string $farmName): self
    {
        $this->farmName = $farmName;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }
}

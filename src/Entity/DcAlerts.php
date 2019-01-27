<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DcAlerts
 *
 * @ORM\Table(name="dc_alerts")
 * @ORM\Entity
 */
class DcAlerts
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
     * @ORM\Column(name="dc_phone", type="string", length=20, nullable=true)
     */
    private $dcPhone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dc_email", type="string", length=150, nullable=true)
     */
    private $dcEmail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dc_sms", type="string", length=20, nullable=true)
     */
    private $dcSms;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dc_chat", type="string", length=50, nullable=true)
     */
    private $dcChat;


}

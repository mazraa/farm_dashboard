<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DcAlertSequence
 *
 * @ORM\Table(name="dc_alert_sequence")
 * @ORM\Entity
 */
class DcAlertSequence
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
     * @ORM\Column(name="dc_capacity", type="string", length=20, nullable=true)
     */
    private $dcCapacity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dc_env", type="string", length=20, nullable=true)
     */
    private $dcEnv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dc_network", type="string", length=20, nullable=true)
     */
    private $dcNetwork;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dc_nodes_status", type="string", length=20, nullable=true)
     */
    private $dcNodesStatus;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dc_alarms_mute", type="string", length=5, nullable=true)
     */
    private $dcAlarmsMute = '0';


}

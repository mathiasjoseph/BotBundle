<?php

namespace Miky\Bundle\BotBundle\Entity;

use Miky\Component\Bot\Model\Port as BasePort;
/**
 * Port
 */
class Port extends BasePort
{
    /**
     * @var int
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}


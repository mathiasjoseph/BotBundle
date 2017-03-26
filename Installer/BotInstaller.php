<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 02/10/16
 * Time: 15:32
 */

namespace Miky\Bundle\BotBundle\Installer;


use Miky\Bundle\BotBundle\EntityManager\PortManager;
use Miky\Bundle\InstallerBundle\Model\InstallerInterface;



class BotInstaller implements InstallerInterface
{

    protected $portManager;

    /**
     * BotInstaller constructor.
     * @param $portManager
     */
    public function __construct(PortManager $portManager)
    {
        $this->portManager = $portManager;
    }


    public function run(){

      $this->generatePorts();

    }

    public function generatePorts(){
        for($i = 0; $i < 8; $i++){
            $port = $this->portManager->createPort();
            if ($this->portManager->findPortBy(array("number" => $i)) == null){
                $port->setNumber($i);
                $this->portManager->updatePort($port);
            }
        }
    }
}
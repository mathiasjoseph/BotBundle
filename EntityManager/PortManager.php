<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 18/12/16
 * Time: 12:48
 */

namespace Miky\Bundle\BotBundle\EntityManager;


use Miky\Bundle\CoreBundle\Manager\AbstractObjectManager;
use Miky\Component\Bot\Model\Port;
use Doctrine\Common\Persistence\ObjectManager;

class PortManager extends AbstractObjectManager
{

    /**
     * Constructor.
     * @param ObjectManager $om
     * @param string $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        parent::__construct($om, $class);
    }

    /**
     * {@inheritDoc}
     */
    public function deletePort(Port $port)
    {
        $this->deleteEntity($port);
    }


    public function findPortsBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function findPortBy(array $criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function findPorts()
    {
        return $this->repository->findAll();
    }

    public function openSession()
    {
        $port = $this->getFreePort();
        if ($port != null){
        $port->setOpen(false);
        $this->updatePort($port);}
        return $port;
    }

    public function closeSession(Port $port)
    {
        $port->setOpen(true);
        $this->updatePort($port);
        return $port;
    }

    public function reloadPort(Port $port)
    {
        $this->objectManager->refresh($port);
    }


    public function getFreePorts(){
        return $this->findPortsBy(array("open" => true));
    }

    /**
     * @return Port
     */
    public function getFreePort(){
        $ports = $this->getFreePorts();
        if ($ports != null){
            $index = array_rand($ports);
            return $ports[$index];
        }else{
            return null;
        }

    }

    public function updatePort(Port $port, $andFlush = true)
    {
        $this->updateEntity($port, $andFlush);
    }

    /**
     * Returns an empty Port instance
     *
     * @return Port
     */
    public function createPort()
    {
        return $this->createEntity();
    }

}
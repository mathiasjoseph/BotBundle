<?php
/**
 * Created by PhpStorm.
 * User: miky
 * Date: 27/11/16
 * Time: 19:59
 */

namespace Miky\Bundle\BotBundle\Controller\Api;

use Miky\Bundle\ApiBundle\Controller\ApiController;
use Miky\Bundle\BotBundle\Entity\Port;
use Miky\Bundle\LBCBundle\Entity\LBCAccount;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;

class PortApiController extends ApiController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Get("/api/bot/port_session/open", name="api_bot_get_free_port", options={ "method_prefix" = false})
     */
    public function openSessionAction()
    {
        $portManager = $this->get("miky_port_manager");
        $port = $portManager->openSession();
        $view = $this->view($port, 200);
        return $this->handleView($view);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Get("/api/bot/port_session/{port}/close", name="api_bot_close_port", options={ "method_prefix" = false})
     */
    public function closeSessionAction(Port $port)
    {
        $portManager = $this->get("miky_port_manager");
        $port = $portManager->closeSession($port);
        $view = $this->view($port, 200);
        return $this->handleView($view);
    }

}
<?php

use PSC7Helper\Services\CommandExecuterServiceInterface;
use Shopware\Components\CSRFWhitelistAware;

class Shopware_Controllers_Backend_PSC7HelperCommand extends Enlight_Controller_Action implements CSRFWhitelistAware
{
    /**
     * @var CommandExecuterServiceInterface
     */
    private $commandExecutorService;

    public function preDispatch()
    {
        $this->commandExecutorService = $this->container->get('psc7_helper.services.command_executer_service');
    }

    public function executeCommandAction()
    {
        $this->container->get('front')->Plugins()->ViewRenderer()->setNoRender();

        if (!$commandName = $this->Request()->getParam('command')) {
            return;
        }

        $executedCommand = $this->commandExecutorService->executeCommand($commandName, $this->Request()->getParam('objectIdentifier'));

        $response = [
            'success' => true,
            'data' => $executedCommand
        ];

        $this->setJsonResponse($response);
    }

    public function getWhitelistedCSRFActions()
    {
        return [
            'executeCommand'
        ];
    }

    private function setJsonResponse(array $data)
    {
        $this->Front()->Plugins()->ViewRenderer()->setNoRender();

        $this->Response()->setHeader('Content-type', 'application/json', true);
        $this->Response()->setBody(json_encode($data));
    }
}
<?php

use PSC7Helper\Services\CommandGeneratorServiceInterface;
use PSC7Helper\Services\CommandsCollectionServiceInterface;
use PSC7Helper\Services\ConnectorBacklogServiceInterface;
use PSC7Helper\Services\ConnectorIdentityServiceInterface;
use PSC7Helper\Services\CronjobServiceInterface;
use Shopware\Components\CSRFWhitelistAware;

class Shopware_Controllers_Backend_PSC7HelperConnector extends Enlight_Controller_Action implements CSRFWhitelistAware
{
    /**
     * @var ConnectorIdentityServiceInterface
     */
    private $identityService;

    /**
     * @var ConnectorBacklogServiceInterface
     */
    private $backlogService;

    /**
     * @var CronjobServiceInterface
     */
    private $cronjobService;

    /**
     * @var CommandGeneratorServiceInterface
     */
    private $commandGeneratorService;

    /**
     * @var CommandsCollectionServiceInterface
     */
    private $commandsCollectionService;

    public function preDispatch()
    {
        $this->identityService = $this->container->get('psc7_helper.services.connector_identity.service');
        $this->backlogService = $this->container->get('psc7_helper.services.connector_backlog_service');
        $this->cronjobService = $this->container->get('psc7_helper.services.cronjob_service');
        $this->commandGeneratorService = $this->container->get('psc7_helper.services.command_generator_service');
        $this->commandsCollectionService = $this->container->get('psc7_helper.services.commands_collection_service');
    }

    public function commandsAction()
    {
        $this->View()->loadTemplate('backend/connector/commands.tpl');

        $availableCommands = [];
        foreach ($this->commandsCollectionService->getAllCommands() as $command) {
            $availableCommands[] = [
                'name' => $command['name'],
                'command' => $command['command'],
                'generatedCommand' => $this->commandGeneratorService->generateCommand($command['name'])
            ];
        }

        $this->View()->assign('availableCommands', $availableCommands);
        $this->View()->assign('lastSyncDate', $this->cronjobService->getLastSyncDate());
        $this->View()->assign('backlogCount', $this->backlogService->countAllBacklogObjects());
    }

    public function searchAction()
    {
        $term = $this->Request()->getParam('term');
        $type = (int)$this->Request()->getParam('type');

        if ($type === 1) {
            $identities = $this->identityService->getAllObjectsByObjectIdentifier($term);
        } elseif ($type === 2) {
            $identities = $this->identityService->getAllObjectsByObjectType($term);
        } elseif ($type === 3) {
            $identities = $this->identityService->getAllObjectsByAdapterIdentifier($term);
        } elseif ($type === 4) {
            $identities = $this->identityService->getAllObjectsByAdapterName($term);
        } else {
            $identities = [];
        }

        $this->View()->loadTemplate('backend/connector/search.tpl');
        $this->View()->assign('identities', $identities);
    }

    public function identitysAction()
    {
        $identitySearchColumns = [
            'objectIdentifier',
            'objectType',
            'adapterIdentifier',
            'adapterName'
        ];

        $this->View()->loadTemplate('backend/connector/identitys.tpl');
        $this->View()->assign('identitySearchColumns', $identitySearchColumns);
    }

    public function getWhitelistedCSRFActions()
    {
        return [
            'commands',
            'search',
            'identitys'
        ];
    }
}
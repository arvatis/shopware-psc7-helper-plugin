<?php

use PSC7Helper\Services\CommandGeneratorServiceInterface;
use PSC7Helper\Services\CommandsCollectionServiceInterface;
use PSC7Helper\Services\ConnectorBacklogServiceInterface;
use PSC7Helper\Services\ConnectorIdentityServiceInterface;
use PSC7Helper\Services\CronjobServiceInterface;
use Shopware\Components\CSRFWhitelistAware;
use SystemConnector\ConfigService\ConfigServiceInterface;

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
     * @var ConfigServiceInterface
     */
    private $configService;

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
        $this->configService = $this->container->get('plenty_connector.config_service');
        $this->cronjobService = $this->container->get('psc7_helper.services.cronjob_service');
        $this->commandGeneratorService = $this->container->get('psc7_helper.services.command_generator_service');
        $this->commandsCollectionService = $this->container->get('psc7_helper.services.commands_collection_service');
    }

    public function settingsAction()
    {
        $this->View()->loadTemplate('backend/connector/settings.tpl');

        $productDefaultNameOptions = [
            1 => 'Name1',
            2 => 'Name2',
            3 => 'Name3'
        ];
        $currentPhpCliPathOption = $this->configService->get('helper.php_cli_path_option', '');
        $currentProductDefaultNameOption = (int)$this->configService->get('helper.product_default_name_option');
        $currentProductDefaultNameOptionFallback = (int)$this->configService->get('helper.product_default_name_option_fallback');
        $currentStockBufferOption = (int)$this->configService->get('helper.stock.stock_buffer_option');

        $this->View()->assign('productDefaultNameOptions', $productDefaultNameOptions);
        $this->View()->assign('currentPhpCliPathOption', $currentPhpCliPathOption);
        $this->View()->assign('currentProductDefaultNameOption', $currentProductDefaultNameOption);
        $this->View()->assign('currentProductDefaultNameOptionFallback', $currentProductDefaultNameOptionFallback);
        $this->View()->assign('currentStockBufferOption', $currentStockBufferOption);
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

    public function saveSettingsAction()
    {
        $phpCliPathOption = $this->Request()->getParam(
            'phpCliPathOption',
            $this->configService->get('helper.php_cli_path_option', '')
        );
        $productDefaultNameOption = (int)$this->Request()->getParam(
            'productDefaultNameOption',
            $this->configService->get('helper.product_default_name_option', 1)
        );
        $productDefaultNameOptionFallback = (int)$this->Request()->getParam(
            'productDefaultNameOptionFallback',
            $this->configService->get('helper.product_default_name_option_fallback', 1)
        );
        $stockBufferOption = (int)$this->Request()->getParam(
            'stockBufferOption',
            $this->configService->get('helper.stock.stock_buffer_option', 0)
        );

        $this->configService->set('helper.php_cli_path_option', $phpCliPathOption);
        $this->configService->set('helper.product_default_name_option', $productDefaultNameOption);
        $this->configService->set('helper.product_default_name_option_fallback', $productDefaultNameOptionFallback);
        $this->configService->set('helper.stock.stock_buffer_option', $stockBufferOption);

        return $this->redirect([
            'controller' => 'PSC7HelperConnector',
            'action' => 'settings'
        ]);
    }

    public function getWhitelistedCSRFActions()
    {
        return [
            'settings',
            'commands',
            'search',
            'identitys',
            'saveSettings'
        ];
    }
}
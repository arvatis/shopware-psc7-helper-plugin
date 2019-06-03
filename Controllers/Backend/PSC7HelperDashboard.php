<?php

use PSC7Helper\Services\ConnectorBacklogServiceInterface;
use PSC7Helper\Services\ConnectorIdentityServiceInterface;
use PSC7Helper\Services\CronjobServiceInterface;
use Shopware\Components\CSRFWhitelistAware;
use SystemConnector\TransferObject\Category\Category;
use SystemConnector\TransferObject\Manufacturer\Manufacturer;
use SystemConnector\TransferObject\Media\Media;
use SystemConnector\TransferObject\Order\Order;
use SystemConnector\TransferObject\Product\Product;
use SystemConnector\TransferObject\Product\Variation\Variation;

class Shopware_Controllers_Backend_PSC7HelperDashboard extends Enlight_Controller_Action implements CSRFWhitelistAware
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

    public function preDispatch()
    {
        $this->identityService = $this->container->get('psc7_helper.services.connector_identity.service');
        $this->backlogService = $this->container->get('psc7_helper.services.connector_backlog_service');
        $this->cronjobService = $this->container->get('psc7_helper.services.cronjob_service');
    }

    public function indexAction()
    {
        $this->View()->loadTemplate('backend/dashboard/index.tpl');

        $cronjobs = $this->cronjobService->getConnectorCronjobs();
        $lastSyncDate = $this->cronjobService->getLastSyncDate();
        $backlogCount = $this->backlogService->countAllBacklogObjects();
        $identityCount = $this->identityService->getAllIdentitiesCount();
        $identityOrderCount = $this->identityService->getIdentitiesCountByObjectType(Order::TYPE);
        $identityProductCount = $this->identityService->getIdentitiesCountByObjectType(Product::TYPE);
        $identityVariationCount = $this->identityService->getIdentitiesCountByObjectType(Variation::TYPE);
        $identityMediaCount = $this->identityService->getIdentitiesCountByObjectType(Media::TYPE);
        $identityCategoryCount = $this->identityService->getIdentitiesCountByObjectType(Category::TYPE);
        $identityManufacturerCount = $this->identityService->getIdentitiesCountByObjectType(Manufacturer::TYPE);

        $this->View()->assign('cronjobs', $cronjobs);
        $this->View()->assign('lastSyncDate', $lastSyncDate);
        $this->View()->assign('backlogCount', $backlogCount);
        $this->View()->assign('identityCount', $identityCount);
        $this->View()->assign('identityOrderCount', $identityOrderCount);
        $this->View()->assign('identityProductCount', $identityProductCount);
        $this->View()->assign('identityVariationCount', $identityVariationCount);
        $this->View()->assign('identityMediaCount', $identityMediaCount);
        $this->View()->assign('identityCategoryCount', $identityCategoryCount);
        $this->View()->assign('identityManufacturerCount', $identityManufacturerCount);
    }

    public function helpAction()
    {
        $this->View()->loadTemplate('backend/dashboard/help.tpl');
    }

    public function getWhitelistedCSRFActions()
    {
        return [
            'index',
            'help'
        ];
    }
}
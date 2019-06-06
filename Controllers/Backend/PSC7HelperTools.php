<?php

use PSC7Helper\Services\ArticleServiceInterface;
use PSC7Helper\Services\OrderServiceInterface;
use Shopware\Components\CSRFWhitelistAware;

class Shopware_Controllers_Backend_PSC7HelperTools extends Enlight_Controller_Action implements CSRFWhitelistAware
{
    /**
     * @var ArticleServiceInterface
     */
    private $articleService;

    /**
     * @var OrderServiceInterface
     */
    private $orderService;

    public function preDispatch()
    {
        $this->articleService = $this->container->get('psc7_helper.services.article_service');
        $this->orderService = $this->container->get('psc7_helper.services.order_service');
    }

    public function articleStatusAction()
    {
        $this->View()->loadTemplate('backend/tools/articleStatus.tpl');

        $articles = $this->articleService->getAllAvailableArticles();
        $this->View()->assign('articles', $articles);
    }

    public function orderSyncAction()
    {
        $this->View()->loadTemplate('backend/tools/orderSync.tpl');

        $orders = $this->orderService->getAllAvailableOrders();
        $this->View()->assign('orders', $orders);
    }

    public function getWhitelistedCSRFActions()
    {
        return [
            'articleStatus',
            'orderSync'
        ];
    }
}
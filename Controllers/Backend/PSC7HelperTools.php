<?php

use PSC7Helper\Services\ArticleServiceInterface;
use Shopware\Components\CSRFWhitelistAware;

class Shopware_Controllers_Backend_PSC7HelperTools extends Enlight_Controller_Action implements CSRFWhitelistAware
{
    /**
     * @var ArticleServiceInterface
     */
    private $articleService;

    public function preDispatch()
    {
        $this->articleService = $this->container->get('psc7_helper.services.article_service');
    }

    public function articleStatusAction()
    {
        $this->View()->loadTemplate('backend/tools/articleStatus.tpl');

        $articles = $this->articleService->getAllAvailableArticles();
        $this->View()->assign('articles', $articles);
    }

    public function getWhitelistedCSRFActions()
    {
        return [
            'articleStatus'
        ];
    }
}
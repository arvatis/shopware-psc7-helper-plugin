<?php

namespace PSC7Helper;

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\InstallContext;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class PSC7Helper extends Plugin
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->setParameter('psc7_helper.plugin_dir', $this->getPath());

        parent::build($container);
    }

    /**
     * {@inheritDoc}
     */
    public function install(InstallContext $context)
    {
        $configService = $this->container->get('plenty_connector.config_service');

        $configService->set('helper.php_cli_path_option', '');
        $configService->set('helper.product_default_name_option', 1);
        $configService->set('helper.product_default_name_option_fallback', 1);
        $configService->set('helper.stock.stock_buffer_option', 0);
    }
}
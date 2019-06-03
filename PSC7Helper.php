<?php

namespace PSC7Helper;

use Shopware\Components\Plugin;
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
}
<?php

/**
 * This file is part of KitanoPelBundle
 *
 * (c) Kitano <contact@kitanolabs.org>
 *
 */

namespace Kitano\PelBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/***
 * Class KitanoPelExtension
 *
 * @author Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class KitanoPelExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('expressions.xml');
    }
}

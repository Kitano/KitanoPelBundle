<?php

/**
 * This file is part of KitanoPelBundle
 *
 * (c) Kitano <contact@kitanolabs.org>
 *
 */

namespace Kitano\PelBundle;

use Kitano\PelBundle\DependencyInjection\Compiler\AddExpressionCompilersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class KitanoPelBundle
 *
 * @author Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class KitanoPelBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddExpressionCompilersPass());
    }
}

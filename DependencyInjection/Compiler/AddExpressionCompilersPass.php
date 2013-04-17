<?php

/**
 * This file is part of KitanoPelBundle
 *
 * (c) Kitano <contact@kitanolabs.org>
 *
 */

namespace Kitano\PelBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AddExpressionCompilersPass
 *
 * @author Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class AddExpressionCompilersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('kitano_pel.expression.compiler')) {
            return;
        }

        $compilerDef = $container->getDefinition('kitano_pel.expression.compiler');
        foreach ($container->findTaggedServiceIds('kitano_pel.expression.function_compiler')
            as $id => $attr) {
            $compilerDef->addMethodCall('addFunctionCompiler', array(new Reference($id)));
        }

        foreach ($container->findTaggedServiceIds('kitano_pel.expression.type_compiler')
            as $id => $attr) {
            $compilerDef->addMethodCall('addTypeCompiler', array(new Reference($id)));
        }
    }
}

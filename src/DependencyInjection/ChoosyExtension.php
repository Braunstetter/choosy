<?php

namespace Braunstetter\Choosy\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class ChoosyExtension extends Extension implements PrependExtensionInterface
{

    public function load(array $configs, ContainerBuilder $container)
    {
        // nothing to load yet
    }

    /**
     * @throws \Exception
     */
    public function prepend(ContainerBuilder $container)
    {
        $phpFileLoader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'));

        if ($container->hasExtension('twig')) {
            $phpFileLoader->load('form_theme.php');
        }
    }
}
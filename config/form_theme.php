<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function(ContainerConfigurator $containerConfigurator): void {

    $containerConfigurator->extension('twig', [
        'form_themes' => ['@Choosy/form/choosy_theme.html.twig'],
    ]);

};
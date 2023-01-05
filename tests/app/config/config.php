<?php

declare(strict_types=1);

use App\Controller\TestController;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function(ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set('kernel.secret', 'for_framework_bundle');
    $parameters->set('locale', 'en');

    $services = $containerConfigurator->services();

    $services->defaults()
        ->public()
        ->autowire()
        ->autoconfigure();

    $services->set(TestController::class)
        ->tag('controller.service_arguments')
        ->tag('controller.service_subscriber')
        ->call('setContainer', [service('service_container')])
        ->public();

};
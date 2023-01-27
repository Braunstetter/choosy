<?php

namespace Braunstetter\Choosy;

use Braunstetter\Choosy\DependencyInjection\ChoosyExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChoosyBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new ChoosyExtension();
    }
}
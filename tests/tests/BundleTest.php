<?php

namespace Braunstetter\Choosy\Tests;

use Braunstetter\Choosy\ChoosyBundle;
use Braunstetter\Choosy\DependencyInjection\ChoosyExtension;
use Nyholm\BundleTest\TestKernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\KernelInterface;

class BundleTest extends KernelTestCase
{
    protected static function getKernelClass(): string
    {
        return TestKernel::class;
    }

    protected static function createKernel(array $options = []): KernelInterface
    {
        /**
         * @var Testkernel $kernel
         */
        $kernel = parent::createKernel($options);
        $kernel->addTestBundle(ChoosyBundle::class);
        $kernel->addTestBundle(TwigBundle::class);

        return $kernel;
    }

    public function testInitBundle(): void
    {
        self::bootKernel();
        $bundle = self::$kernel->getBundle('ChoosyBundle');
        $this->assertInstanceOf(ChoosyBundle::class, $bundle);
        $this->assertInstanceOf(ChoosyExtension::class, $bundle->getContainerExtension());
    }
}
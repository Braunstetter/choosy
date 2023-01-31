<?php

namespace Braunstetter\Choosy\Tests\Functional;

use App\ChoosyBundleKernel;
use Braunstetter\Choosy\Tests\TestHelper;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Panther\Client;
use Symfony\Component\Panther\WebTestAssertionsTrait;

class AbstractFunctionalTestCase extends TestCase
{
    use WebTestAssertionsTrait;
    public const FIREFOX = 'firefox';
    public const CHROME = 'chrome';

    public KernelInterface $kernel;

    protected function setUp(): void
    {
        $this->kernel = static::bootKernel($this->provideCustomConfigs());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->takeScreenshotIfTestFailed();
    }

    protected static function bootKernel(array $options): KernelInterface
    {
        $kernel = static::createKernel($options);
        $kernel->boot();
        return $kernel;
    }

    protected static function createKernel(array $options): KernelInterface
    {
        return new ChoosyBundleKernel($options);
    }

    /**
     * @return string[]
     */
    protected function provideCustomConfigs(): array
    {
        return [];
    }

    protected function initPantherClient(): Client
    {
        return static::createPantherClient(
            array_replace(static::$defaultOptions, [
                'webServerDir' => TestHelper::getPublicDir(),
                'port' => 9081
            ]));
    }
}
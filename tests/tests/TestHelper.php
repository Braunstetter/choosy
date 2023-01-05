<?php

namespace Braunstetter\Choosy\Tests;


class TestHelper
{

    public static function getProjectDir(): string
    {
        return realpath(dirname(__FILE__) . "/../app");
    }

    public static function getPublicDir(): string
    {
        return static::getProjectDir() . '/public';
    }

    public static function getAssetsDir(): string
    {
        return static::getProjectDir() . '/assets';
    }

    public static function getTestsDir(): string
    {
        return static::getPublicDir() . '/tests';
    }

    public static function getImagesDir(): string
    {
        return static::getTestsDir() . '/images';
    }

}
<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit03aeb8a472eef5c303f990a6ae9b0285
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' =>
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Process\\' => 26,
            'Symfony\\Component\\Debug\\' => 24,
            'Symfony\\Component\\Console\\' => 26,
        ),
        'P' =>
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Http\\Message\\' => 17,
            'PhpConsole\\' => 11,
        ),
        'N' =>
        array (
            'utilityClasses\\' => 6,
        ),
        'I' =>
        array (
            'Intervention\\Image\\' => 19,
            'BwwClasses\\' => 5,
        ),
        'G' =>
        array (
            'GuzzleHttp\\Psr7\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' =>
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Component\\Yaml\\' =>
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Process\\' =>
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'Symfony\\Component\\Debug\\' =>
        array (
            0 => __DIR__ . '/..' . '/symfony/debug',
        ),
        'Symfony\\Component\\Console\\' =>
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Psr\\Log\\' =>
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Http\\Message\\' =>
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'PhpConsole\\' =>
        array (
            0 => __DIR__ . '/..' . '/php-console/php-console/src/PhpConsole',
        ),
        'utilityClasses\\' =>
        array (
            0 => __DIR__ . '/../..' . '/classes/utilityClasses',
        ),
        'Intervention\\Image\\' =>
        array (
            0 => __DIR__ . '/..' . '/intervention/image/src/Intervention/Image',
        ),
        'BwwClasses\\' =>
        array (
            0 => __DIR__ . '/../..' . '/classes/BwwClasses',
        ),
        'GuzzleHttp\\Psr7\\' =>
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit03aeb8a472eef5c303f990a6ae9b0285::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit03aeb8a472eef5c303f990a6ae9b0285::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
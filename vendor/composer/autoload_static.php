<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit344bea4311de40a6e0ab75bdf4ff9f45
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Mxz\\Blog\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Mxz\\Blog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit344bea4311de40a6e0ab75bdf4ff9f45::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit344bea4311de40a6e0ab75bdf4ff9f45::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit344bea4311de40a6e0ab75bdf4ff9f45::$classMap;

        }, null, ClassLoader::class);
    }
}
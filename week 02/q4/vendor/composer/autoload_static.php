<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcc22d17aff5224d2900a45765721d518
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Parsa\\Q4\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Parsa\\Q4\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitcc22d17aff5224d2900a45765721d518::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcc22d17aff5224d2900a45765721d518::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcc22d17aff5224d2900a45765721d518::$classMap;

        }, null, ClassLoader::class);
    }
}
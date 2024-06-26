<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit52ef1df7b73c4a9e1c2c01fb0217e6a0
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Laravel\\ModelEvents\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Laravel\\ModelEvents\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit52ef1df7b73c4a9e1c2c01fb0217e6a0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit52ef1df7b73c4a9e1c2c01fb0217e6a0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit52ef1df7b73c4a9e1c2c01fb0217e6a0::$classMap;

        }, null, ClassLoader::class);
    }
}

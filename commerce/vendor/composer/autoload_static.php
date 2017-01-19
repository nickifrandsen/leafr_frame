<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc8f4f8f5f1402217b5543ebe9bdf0101
{
    public static $files = array (
        'f4eed2ef927ac4b0a4c202266938311f' => __DIR__ . '/../..' . '/src/Support/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Leafr\\Commerce\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Leafr\\Commerce\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc8f4f8f5f1402217b5543ebe9bdf0101::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc8f4f8f5f1402217b5543ebe9bdf0101::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}

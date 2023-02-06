<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita1f4f5d611227c3bbbce48e9c2091c6d
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita1f4f5d611227c3bbbce48e9c2091c6d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita1f4f5d611227c3bbbce48e9c2091c6d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita1f4f5d611227c3bbbce48e9c2091c6d::$classMap;

        }, null, ClassLoader::class);
    }
}

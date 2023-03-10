<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita1f4f5d611227c3bbbce48e9c2091c6d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInita1f4f5d611227c3bbbce48e9c2091c6d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita1f4f5d611227c3bbbce48e9c2091c6d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita1f4f5d611227c3bbbce48e9c2091c6d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}

<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7992a442a85bd2a13fcc79737c5b99fa
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit7992a442a85bd2a13fcc79737c5b99fa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7992a442a85bd2a13fcc79737c5b99fa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7992a442a85bd2a13fcc79737c5b99fa::$classMap;

        }, null, ClassLoader::class);
    }
}

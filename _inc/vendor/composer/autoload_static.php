<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9300685f1934e027c0da8a4ed7d63a6a
{
    public static $files = array (
        '6157b075b923803e5ef157aeb43b83bd' => __DIR__ . '/..' . '/tamtamchik/simple-flash/src/function.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'ZxcvbnPhp\\' => 10,
        ),
        'W' => 
        array (
            'Whoops\\' => 7,
        ),
        'T' => 
        array (
            'Tamtamchik\\SimpleFlash\\' => 23,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'Medoo\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'ZxcvbnPhp\\' => 
        array (
            0 => __DIR__ . '/..' . '/bjeavons/zxcvbn-php/src',
        ),
        'Whoops\\' => 
        array (
            0 => __DIR__ . '/..' . '/filp/whoops/src/Whoops',
        ),
        'Tamtamchik\\SimpleFlash\\' => 
        array (
            0 => __DIR__ . '/..' . '/tamtamchik/simple-flash/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Medoo\\' => 
        array (
            0 => __DIR__ . '/..' . '/catfan/medoo/src',
        ),
    );

    public static $classMap = array (
        'FPDF' => __DIR__ . '/..' . '/setasign/fpdf/fpdf.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9300685f1934e027c0da8a4ed7d63a6a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9300685f1934e027c0da8a4ed7d63a6a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit9300685f1934e027c0da8a4ed7d63a6a::$classMap;

        }, null, ClassLoader::class);
    }
}

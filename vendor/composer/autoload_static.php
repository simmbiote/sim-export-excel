<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite70db3148340290fb628e7589551d143
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/admin/includes',
        ),
    );

    public static $classMap = array (
        'XLSXWriter' => __DIR__ . '/..' . '/mk-j/php_xlsxwriter/xlsxwriter.class.php',
        'XLSXWriter_BuffererWriter' => __DIR__ . '/..' . '/mk-j/php_xlsxwriter/xlsxwriter.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite70db3148340290fb628e7589551d143::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite70db3148340290fb628e7589551d143::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite70db3148340290fb628e7589551d143::$classMap;

        }, null, ClassLoader::class);
    }
}

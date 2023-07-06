<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit418901167dc7007d827c3701a2b7a398
{
    public static $files = array (
        '2cffec82183ee1cea088009cef9a6fc3' => __DIR__ . '/..' . '/ezyang/htmlpurifier/library/HTMLPurifier.composer.php',
        'c9d07b32a2e02bc0fc582d4f0c1b56cc' => __DIR__ . '/..' . '/laminas/laminas-servicemanager/src/autoload.php',
        'fbeead2280a8f3911a1fe6dd034f7d5e' => __DIR__ . '/..' . '/mkalkbrenner/php-htmldiff-advanced/src/HtmlDiffAdvancedInterface.php',
        '96f8d8288528d52059397cad6ec61f17' => __DIR__ . '/..' . '/mkalkbrenner/php-htmldiff-advanced/src/HtmlDiffAdvanced.php',
    );

    public static $prefixLengthsPsr4 = array (
        'v' => 
        array (
            'voku\\helper\\' => 12,
        ),
        'Z' => 
        array (
            'ZipStream\\' => 10,
        ),
        'S' => 
        array (
            'Symfony\\Component\\CssSelector\\' => 30,
        ),
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
            'Psr\\Container\\' => 14,
            'PhpOffice\\PhpSpreadsheet\\' => 25,
        ),
        'M' => 
        array (
            'Matrix\\' => 7,
        ),
        'L' => 
        array (
            'Laminas\\Stdlib\\' => 15,
            'Laminas\\ServiceManager\\' => 23,
            'Laminas\\Feed\\' => 13,
            'Laminas\\Escaper\\' => 16,
        ),
        'J' => 
        array (
            'Jfcherng\\Utility\\' => 17,
            'Jfcherng\\Diff\\' => 14,
        ),
        'H' => 
        array (
            'Html2Text\\' => 10,
        ),
        'C' => 
        array (
            'Complex\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'voku\\helper\\' => 
        array (
            0 => __DIR__ . '/..' . '/voku/simple_html_dom/src/voku/helper',
        ),
        'ZipStream\\' => 
        array (
            0 => __DIR__ . '/..' . '/maennchen/zipstream-php/src',
        ),
        'Symfony\\Component\\CssSelector\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/css-selector',
        ),
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-factory/src',
            1 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'PhpOffice\\PhpSpreadsheet\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpspreadsheet/src/PhpSpreadsheet',
        ),
        'Matrix\\' => 
        array (
            0 => __DIR__ . '/..' . '/markbaker/matrix/classes/src',
        ),
        'Laminas\\Stdlib\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-stdlib/src',
        ),
        'Laminas\\ServiceManager\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-servicemanager/src',
        ),
        'Laminas\\Feed\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-feed/src',
        ),
        'Laminas\\Escaper\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-escaper/src',
        ),
        'Jfcherng\\Utility\\' => 
        array (
            0 => __DIR__ . '/..' . '/jfcherng/php-color-output/src',
            1 => __DIR__ . '/..' . '/jfcherng/php-mb-string/src',
        ),
        'Jfcherng\\Diff\\' => 
        array (
            0 => __DIR__ . '/..' . '/jfcherng/php-diff/src',
            1 => __DIR__ . '/..' . '/jfcherng/php-sequence-matcher/src',
        ),
        'Html2Text\\' => 
        array (
            0 => __DIR__ . '/..' . '/html2text/html2text/src',
            1 => __DIR__ . '/..' . '/html2text/html2text/test',
        ),
        'Complex\\' => 
        array (
            0 => __DIR__ . '/..' . '/markbaker/complex/classes/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'H' => 
        array (
            'HTMLPurifier' => 
            array (
                0 => __DIR__ . '/..' . '/ezyang/htmlpurifier/library',
            ),
        ),
        'C' => 
        array (
            'Caxy\\HtmlDiff' => 
            array (
                0 => __DIR__ . '/..' . '/caxy/php-htmldiff/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit418901167dc7007d827c3701a2b7a398::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit418901167dc7007d827c3701a2b7a398::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit418901167dc7007d827c3701a2b7a398::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit418901167dc7007d827c3701a2b7a398::$classMap;

        }, null, ClassLoader::class);
    }
}

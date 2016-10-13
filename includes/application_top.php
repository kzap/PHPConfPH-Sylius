<?php

// auto load composer
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/autoload.php';


$loader = new \Example\Psr4AutoloaderClass;
// register the autoloader
$loader->register();
// register the base directories for the namespace prefix
$loader->addNamespace('Lib', __DIR__.'/../Lib');

// connect to database
$mysqli = new mysqli('127.0.0.1', 'phpconfph', '', 'phpconfph_sylius');
if ($mysqli->connect_error) {
    die('Connect Error ('.$mysqli->connect_errno.') '
            .$mysqli->connect_error);
}
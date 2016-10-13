<?php

// auto load composer
require_once __DIR__.'/../vendor/autoload.php';

// connect to database
$mysqli = new mysqli('127.0.0.1', 'phpconfph', '', 'phpconfph_sylius');
if ($mysqli->connect_error) {
    die('Connect Error ('.$mysqli->connect_errno.') '
            .$mysqli->connect_error);
}
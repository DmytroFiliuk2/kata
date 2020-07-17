<?php

require_once 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__ . "/src"), $isDevMode,null, null, false);

$connection = array(
    "dbname" => "doctrine",
    "user" => "root",
    "password" => "",
    "host" => "localhost",
    "driver" => "pdo_mysql"
);

$entityManager = EntityManager::create($connection,$config);
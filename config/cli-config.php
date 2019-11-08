<?php
require __DIR__ . '/../vendor/autoload.php';
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Console\Helper\HelperSet;

$paths = [dirname( __DIR__, 1) . '/src/Model/Entities'];
$isDevMode = true;
$dbParams = include 'migrations-db.php';
$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, null, null, false);
$entityManager = EntityManager::create($dbParams, $config);
return new HelperSet(
    [
        'em' => new EntityManagerHelper($entityManager),
        'db' => new ConnectionHelper($entityManager->getConnection()),
    ]
);

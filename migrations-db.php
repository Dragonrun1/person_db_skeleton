<?php
declare(strict_types=1);
$platform = $platform ?? 'mysql';
switch ($platform) {
    case 'mysql':
        return [
            'charset' => 'utf8mb4',
            'collate' => 'utf8mb4_general_ci',
            'dbname' => 'person_db_skeleton',
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'password' => 'secret',
            'user' => 'PDBSUser',
        ];
    case 'pgsql':
    case 'postgres':
        return [
            'dbname' => 'person_db_skeleton',
            'driver' => 'pdo_pgsql',
            'host' => 'localhost',
            'password' => 'secret',
            'user' => 'postgres',
        ];
    case 'sqlite':
        return [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/person_db_skeleton.sq3',
        ];
    default:
        return [];
}

<?php
declare(strict_types=1);
/**
 * Contains pds-migrations cli tool.
 *
 * PHP version 7.3
 *
 * LICENSE:
 * This file is part of person_db_skeleton which is a set of skeleton database
 * tables for people and common associated data.
 *
 * Copyright (C) 2019 Michael Cummings. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation and/or
 * other materials provided with the distribution.
 *
 * 3. Neither the name of the copyright holder nor the names of its contributors
 * may be used to endorse or promote products derived from this software without
 * specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * You should have received a copy of the BSD-3 Clause License along with
 * this program. If not, see
 * <https://spdx.org/licenses/BSD-3-Clause.html>.
 *
 * You should be able to find a copy of this license in the LICENSE file.
 *
 * @author    Michael Cummings <mgcummings@yahoo.com>
 * @copyright 2019 Michael Cummings
 * @license   BSD-3-Clause
 */
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\Configuration\Configuration as MConfiguration;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\Migrations\Tools\Console\Helper\ConfigurationHelper;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use PersonDBSkeleton\Utils\EManager;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Helper\QuestionHelper;
use Uuid64Type\Type\Uuid64Type;

require_once dirname(__DIR__) . '/vendor/autoload.php';
$dir = \str_replace('\\', '/', \dirname(__DIR__));
$dotEnv = require dirname(__DIR__) . '/config/dotEnv-config.php';
$env = $dotEnv->toArray();
$platform = $env['platform'];
$isDevMode = $env['devMode'];
$dbParams = $env[$platform];
try {
    $conn = DriverManager::getConnection($dbParams);
    $config = new MConfiguration($conn);
} catch (\Exception $e) {
    print $e->getTraceAsString();
    print $e->getMessage();
    exit(1);
}
$migrations = $env['migrations'];
foreach ($migrations as $key => $value) {
    $method = 'set' . $key;
    print $method . PHP_EOL;
    if ('MigrationsDirectory' === $key) {
        $value = $dir . $value;
        print $value . PHP_EOL;
    }
    if (\method_exists($config, $method)) {
        $config->$method($value);
    }
}
$em = new class {
    use EManager;
};
$entityManager = $em->getEntityManager($env, $isDevMode, $dir, $dbParams);
$type = Uuid64Type::UUID64;
try {
    Type::addType($type, Uuid64Type::class);
    $conn->getDatabasePlatform()
         ->registerDoctrineTypeMapping($type, 'string');
    $conn->getDatabasePlatform()
         ->markDoctrineTypeCommented($type);
} catch (\Exception $e) {
    print $e->getMessage() . PHP_EOL;
    print $e->getTraceAsString();
    exit(1);
}
$helperSet = new HelperSet();
$helperSet->set(new QuestionHelper(), 'question');
$helperSet->set(new ConnectionHelper($conn), 'db');
$helperSet->set(new ConfigurationHelper($conn, $config));
// TODO: Add Doctrine entity manager stuff above.
$helperSet->set(new EntityManagerHelper($entityManager), 'em');
$cli = new Application('PDS Migrations');
$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);
$cli->addCommands(
    [
        new Command\DumpSchemaCommand(),
        new Command\ExecuteCommand(),
        new Command\DiffCommand(),
        new Command\GenerateCommand(),
        new Command\LatestCommand(),
        new Command\MigrateCommand(),
        new Command\RollupCommand(),
        new Command\StatusCommand(),
        new Command\UpToDateCommand(),
        new Command\VersionCommand(),
    ]
);
try {
    $cli->run();
} catch (Exception $e) {
    print $e->getTraceAsString();
    print $e->getMessage();
    exit(2);
}

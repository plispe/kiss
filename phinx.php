<?php

/**
 * Phinx configuration file
 * @see http://docs.phinx.org/en/latest/configuration.html
 *
 * For using Phinx please install "robmorgan/phinx" composer package
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

// ENV variables
require_once __DIR__ . '/app/environment.php';

/**
 * DSN string parser
 * @see https://github.com/AD7six/php-dsn
 * @var AD7six
 */
$databaseDsn = new AD7six\Dsn\DbDsn(getenv('DATABASE_DSN'));

return [
    // Paths
    'paths' => [
        // Path to migrations dir
        'migrations' => __DIR__ . '/app/_db/migrations',
    ],

    // Defined environments
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'database',

        // Development database
        'database' => [
            'adapter' => $databaseDsn->getEngine(),
            'host' => $databaseDsn->getHost(),
            'name' => $databaseDsn->getDatabase(),
            'user' => $databaseDsn->getUser(),
            'pass' => $databaseDsn->getPass(),
            'port' => $databaseDsn->getPort(),
            'charset' => 'utf8'
        ]
    ]
];

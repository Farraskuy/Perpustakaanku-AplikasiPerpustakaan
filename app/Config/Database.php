<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     */
    public array $default = [
        'DSN' => '',
        'hostname' => 'localhost',
        'username' => '',
        'password' => '',
        'database' => '',
        'DBDriver' => 'MySQLi',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug' => true,
        'charset' => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre' => '',
        'encrypt' => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port' => 3306,
    ];

    public function __construct()
    {
        parent::__construct();

        // Enable SSL for Azure MySQL (requires secure transport)
        // Check multiple environment variable formats
        $sslEnabled = getenv('database.default.encrypt')
            ?: getenv('DB_ENCRYPT')
            ?: ($_ENV['database.default.encrypt'] ?? null)
            ?: ($_SERVER['database.default.encrypt'] ?? null)
            ?: ($_ENV['DB_ENCRYPT'] ?? null);

        // Also enable SSL if running in production environment
        $environment = getenv('CI_ENVIRONMENT')
            ?: ($_ENV['CI_ENVIRONMENT'] ?? null)
            ?: ($_SERVER['CI_ENVIRONMENT'] ?? null)
            ?: 'development';

        // Enable SSL if explicitly set OR if in production
        if ($sslEnabled === 'true' || $sslEnabled === '1' || $environment === 'production') {
            $this->default['encrypt'] = [
                'ssl_verify' => false,
                'ssl_ca' => null,
                'ssl_capath' => null,
                'ssl_cert' => null,
                'ssl_cipher' => null,
                'ssl_key' => null,
            ];
        }
    }

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
    public array $tests = [
        'DSN' => '',
        'hostname' => '127.0.0.1',
        'username' => '',
        'password' => '',
        'database' => ':memory:',
        'DBDriver' => 'SQLite3',
        'DBPrefix' => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect' => false,
        'DBDebug' => true,
        'charset' => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre' => '',
        'encrypt' => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port' => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];
}

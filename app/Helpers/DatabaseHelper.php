<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

/**
 * Helper class untuk mengelola multiple database connections
 */
class DatabaseHelper
{
    /**
     * Database connection names
     */
    const ACCOUNT_DB = 'account';
    const SERVICES_DB = 'services';
    const DEFAULT_DB = 'mysql';

    /**
     * Get account database connection
     */
    public static function account()
    {
        return DB::connection(self::ACCOUNT_DB);
    }

    /**
     * Get services database connection
     */
    public static function services()
    {
        return DB::connection(self::SERVICES_DB);
    }

    /**
     * Get default database connection
     */
    public static function default()
    {
        return DB::connection(self::DEFAULT_DB);
    }

    /**
     * Test database connections
     */
    public static function testConnections()
    {
        $results = [];

        try {
            self::account()->getPdo();
            $results[self::ACCOUNT_DB] = 'Connected';
        } catch (\Exception $e) {
            $results[self::ACCOUNT_DB] = 'Failed: ' . $e->getMessage();
        }

        try {
            self::services()->getPdo();
            $results[self::SERVICES_DB] = 'Connected';
        } catch (\Exception $e) {
            $results[self::SERVICES_DB] = 'Failed: ' . $e->getMessage();
        }

        try {
            self::default()->getPdo();
            $results[self::DEFAULT_DB] = 'Connected';
        } catch (\Exception $e) {
            $results[self::DEFAULT_DB] = 'Failed: ' . $e->getMessage();
        }

        return $results;
    }

    /**
     * Get database configuration for a connection
     */
    public static function getConnectionConfig($connection)
    {
        return Config::get("database.connections.{$connection}");
    }

    /**
     * Check if database exists
     */
    public static function databaseExists($connection)
    {
        try {
            $config = self::getConnectionConfig($connection);
            $tempConnection = [
                'driver' => $config['driver'],
                'host' => $config['host'],
                'port' => $config['port'],
                'username' => $config['username'],
                'password' => $config['password'],
                'charset' => $config['charset'] ?? 'utf8mb4',
                'collation' => $config['collation'] ?? 'utf8mb4_unicode_ci',
            ];

            // Connect without database name to check if database exists
            Config::set('database.connections.temp_check', $tempConnection);
            
            $databases = DB::connection('temp_check')
                ->select('SHOW DATABASES LIKE ?', [$config['database']]);

            return count($databases) > 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Create database if not exists
     */
    public static function createDatabase($connection)
    {
        try {
            $config = self::getConnectionConfig($connection);
            $databaseName = $config['database'];

            $tempConnection = [
                'driver' => $config['driver'],
                'host' => $config['host'],
                'port' => $config['port'],
                'username' => $config['username'],
                'password' => $config['password'],
                'charset' => $config['charset'] ?? 'utf8mb4',
                'collation' => $config['collation'] ?? 'utf8mb4_unicode_ci',
            ];

            Config::set('database.connections.temp_create', $tempConnection);
            
            DB::connection('temp_create')
                ->statement("CREATE DATABASE IF NOT EXISTS `{$databaseName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

            return true;
        } catch (\Exception $e) {
            throw new \Exception("Failed to create database: " . $e->getMessage());
        }
    }

    /**
     * Run migrations for specific connection
     */
    public static function runMigrations($connection, $path = null)
    {
        $command = "php artisan migrate:database {$connection}";
        
        if ($path) {
            $command .= " --path={$path}";
        }

        return shell_exec($command);
    }
}

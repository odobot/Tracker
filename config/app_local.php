<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', '85bc5effac72bd7210c0a23e2e06449b00b7c7f25526a11a1fd8c57ce9fe32ad'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'className' => \Cake\Database\Connection::class,
            'driver' => \Cake\Database\Driver\Sqlserver::class,
            'persistent' => false,
            'host' => 'localhost',
            'username' => 'SA',
            'password' => '57159399@Pn',
            'database' => 'TrackerDB',
            'port' => 1433,
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => true,
        ],
        'test' => [
            'className' => \Cake\Database\Connection::class,
            'driver' => \Cake\Database\Driver\Sqlserver::class,
            'persistent' => false,
            'host' => 'localhost',
            'username' => 'SA',
            'password' => '57159399@Pn',
            'database' => 'TrackerDB',
            'port' => 1433,
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => true,
            'log' => true,
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
    'Error' => [
        'errorLevel' => E_ALL,
        'exceptionRenderer' => 'Cake\Error\ExceptionRenderer',
        'skipLog' => [],
        'log' => true,
        'trace' => true,  // ← Enable stack traces
    ],
];

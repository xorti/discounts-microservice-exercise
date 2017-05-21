<?php

$settings = [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    'src/Entities'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'database',
                'user'     => 'username',
                'password' => 'password',
            ]
        ]
    ],
];

/** Override default settings with specific environment settings */
if (file_exists('../active_env')){
    $activeEnv = file_get_contents('../active_env');

    $path = '../environments/' . $activeEnv . '.php';
    if (file_exists($path)){
        require_once $path;
    }
}

return $settings;

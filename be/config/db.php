<?php
// db.php

use Psr\Container\ContainerInterface;

return function (ContainerInterface $container) {
    $settings = $container->get('settings')['db'];

    $dsn = "mysql:host={$settings['host']};dbname={$settings['dbname']};charset={$settings['charset']}";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    return new PDO($dsn, $settings['user'], $settings['pass'], $options);
};

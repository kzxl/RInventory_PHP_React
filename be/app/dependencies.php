<?php

declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

function registerClassesFromFolder(DI\ContainerBuilder $containerBuilder, string $folder, string $namespacePrefix) {
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($folder));
    foreach ($files as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            // Lấy path tương đối so với folder
            $relativePath = substr($file->getRealPath(), strlen($folder) + 1); // +1 để bỏ dấu /
            // Đổi dấu / hoặc \ thành namespace separator \
            $classPath = str_replace(['/', '\\'], '\\', $relativePath);
            // Bỏ đuôi .php
            $className = $namespacePrefix . '\\' . substr($classPath, 0, -4);

            if (class_exists($className)) {
                $containerBuilder->addDefinitions([
                    $className => DI\autowire(),
                ]);
            }
        }
    }
}


return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        // DB Connect
            PDO::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class)->get('db');

            $dsn = "mysql:host={$settings['host']};dbname={$settings['dbname']};charset={$settings['charset']}";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            return new PDO($dsn, $settings['user'], $settings['pass'], $options);
        },
        
       
        
    ]);
    //Đăng ký
    registerClassesFromFolder($containerBuilder, __DIR__ . '/../src/Services', 'App\Service');
    registerClassesFromFolder($containerBuilder, __DIR__ . '/../src/Repositories', 'App\Repository');
    registerClassesFromFolder($containerBuilder, __DIR__ . '/../src/Controllers', 'App\Controller');

};

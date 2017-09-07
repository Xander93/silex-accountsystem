<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application;

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider, [
    'twig.path' => __DIR__ . '/../app/views'
]);

$app->register(new Silex\Provider\DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'accounts',
        'user' => 'xander',
        'password' => 'Welkom123',
        'charset' => 'utf8',
    ],
]);

$app->register(new Silex\Provider\FormServiceProvider());

return $app;
<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application;

$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider, [
    'twig.path' => __DIR__ . '/../views'
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

$app->get('/', function () use ($app) {

    return $app['twig']->render('signup.twig');
});

$app->post('/', function () use ($app) {

    if ($_POST['password'] == $_POST['repassword']) {

        function protect_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $username = protect_input($_POST['username']);
        $email = protect_input($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        /** @var \Doctrine\DBAL\Connection $db */
        $db = $app['db'];
        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ];
        $db->insert('users', $data);

        return $app['twig']->render('signed.twig');
    }

    return $app['twig']->render('signup.twig');
});

$app->run();
<?php

use App\Database\Database;

$container = $app->getcontainer();

$container->set('pdo', function () {
    $pdo = new PDO('mysql:dbname=test;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
});

$container->set('db', function ($container) {
    $db =  new Database($container->get('pdo'), $container);
    return $db;
});

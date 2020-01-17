<?php

use DI\Container;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Create Container using PHP-DI
$container = new Container();

// Set that to your needs
$displayErrorDetails = true;

// $app = AppFactory::createFromContainer($container);

AppFactory::setContainer($container);
$app = AppFactory::create();

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

require __DIR__ . '/../app/container.php';

$app->get('/', \App\Controllers\PagesController::class . ':home');

$app->run();
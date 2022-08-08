<?php

use Slim\App;
use App\Middleware\LoginMiddleware;
// use Selective\Config\Configuration;
// use Slim\Middleware\ErrorMiddleware;
use Selective\BasePath\BasePathMiddleware;

return function (App $app) {
    // Parse json, form data and xml
    $app->addBodyParsingMiddleware();

    // Add CORS middleware
    $app->add(\App\Middleware\CorsMiddleware::class);

    // Add routing middleware
    $app->addRoutingMiddleware();

    $app->add(BasePathMiddleware::class);

    $container = $app->getContainer();

    // Add error handler middleware
    // $settings = $container->get(Configuration::class)->getArray('error_handler_middleware');
    // $displayErrorDetails = (bool) $settings['display_error_details'];
    // $logErrors = (bool) $settings['log_errors'];
    // $logErrorDetails = (bool) $settings['log_error_details'];

    // $app->addErrorMiddleware($displayErrorDetails, $logErrors, $logErrorDetails);

    // Handle exceptions
    $app->add(ErrorMiddleware::class);

    $app->add(new LoginMiddleware());
};

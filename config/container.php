<?php

use Slim\App;
use App\Auth\JwtAuth;
use Slim\Factory\AppFactory;
use Slim\Middleware\ErrorMiddleware;
use Psr\Container\ContainerInterface;
use Selective\BasePath\BasePathMiddleware;
use Psr\Http\Message\ResponseFactoryInterface;

return [
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        // Optional: Set the base path to run the app in a sub-directory
        // The public directory must not be part of the base path
        // $app->setBasePath('/pvappcore');

        return $app;
    },

    // ResponseFactoryInterface::class => function (ContainerInterface $container) {
    //     return $container->get(App::class)->getResponseFactory();
    // },

    ErrorMiddleware::class => function (ContainerInterface $container) {
        $app = $container->get(App::class);
        $settings = $container->get('settings')['error'];

        return new ErrorMiddleware(
            $app->getCallableResolver(),
            $app->getResponseFactory(),
            (bool)$settings['display_error_details'],
            (bool)$settings['log_errors'],
            (bool)$settings['log_error_details']
        );
    },

    // And add this entry
    JwtAuth::class => function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class);

        $issuer = $settings->getString('jwt.issuer');
        $lifetime = $settings->getInt('jwt.lifetime');
        $privateKey = $settings->getString('jwt.private_key');
        $publicKey = $settings->getString('jwt.public_key');

        return new JwtAuth($issuer, $lifetime, $privateKey, $publicKey);
    },

    PDO::class => function (ContainerInterface $container) {
        $settings = $container->get(Configuration::class);

        $host = $settings->getString('db.host');
        $dbname =  $settings->getString('db.database');
        $username = $settings->getString('db.username');
        $password = $settings->getString('db.password');
        $charset = $settings->getString('db.charset');
        $flags = $settings->getArray('db.flags');
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        return new PDO($dsn, $username, $password, $flags);
    },

    BasePathMiddleware::class => function (ContainerInterface $container) {
        return new BasePathMiddleware($container->get(App::class));
    },
];

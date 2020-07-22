<?php

use Slim\App;
use App\Auth\JwtAuth;
use Slim\Factory\AppFactory;
use Selective\Config\Configuration;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;

return [
    Configuration::class => function () {
        return new Configuration(require __DIR__ . '/settings.php');
    },

    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        // Optional: Set the base path to run the app in a sub-directory
        // The public directory must not be part of the base path
        //$app->setBasePath('/slim4-tutorial');

        return $app;
    },

    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },

    // And add this entry
    JwtAuth::class => function (ContainerInterface $container) {
        $config = $container->get(Configuration::class);

        $issuer = $config->getString('jwt.issuer');
        $lifetime = $config->getInt('jwt.lifetime');
        $privateKey = $config->getString('jwt.private_key');
        $publicKey = $config->getString('jwt.public_key');

        return new JwtAuth($issuer, $lifetime, $privateKey, $publicKey);
    },

    PDO::class => function (ContainerInterface $container) {
        $config = $container->get(Configuration::class);

        $host = $config->getString('db.host');
        $dbname =  $config->getString('db.database');
        $username = $config->getString('db.username');
        $password = $config->getString('db.password');
        $charset = $config->getString('db.charset');
        $flags = $config->getArray('db.flags');
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        return new PDO($dsn, $username, $password, $flags);
    },


];

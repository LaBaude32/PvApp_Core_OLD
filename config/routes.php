<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
    $app->post('/addUser', \App\Action\UserCreateAction::class);
    $app->get('/getAllUsers', \App\Action\UsersGetAllAction::class);
};


<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
    $app->post('/addPersonne', \App\Action\UserCreateAction::class);
    $app->get('/getAllPersonnes', \App\Action\UsersGetAllAction::class);
    $app->post('/addAffaire', \App\Action\AffaireCreateAction::class);
    $app->get('/getAllAffaires', \App\Action\AffairesGetAllAction::class);
    $app->post('/addLot', \App\Action\LotCreateAction::class);
    $app->get('/getAffaireById', \App\Action\AffaireGetByIdAction::class);
    $app->post('/addPv', \App\Action\PvCreateAction::class);
    $app->get('/getPvByAffaireId', \App\Action\PvGetByAffaireIdAction::class);
    $app->post('/addPvUpdater', \App\Action\PvUpdateAction::class);
};


<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
    //User
    $app->post('/addUser', \App\Action\UserCreateAction::class);
    $app->get('/getAllUsers', \App\Action\UsersGetAllAction::class);
    //Affair
    $app->post('/addAffair', \App\Action\AffairCreateAction::class);
    $app->get('/getAllAffairs', \App\Action\AffairsGetAllAction::class);
    $app->get('/getAffairById', \App\Action\AffairGetByIdAction::class);
    $app->post('/updateAffair', \App\Action\AffairUpdateAction::class);
    //Lot
    $app->post('/addLot', \App\Action\LotCreateAction::class);
    //Pv
    $app->post('/addPv', \App\Action\PvCreateAction::class);
    $app->get('/getPvByAffairId', \App\Action\PvGetByAffairIdAction::class);
    $app->post('/updatePv', \App\Action\PvUpdateAction::class);
    $app->get('/getPvDetails', \App\Action\PvGetByIdAction::class);
    //Pv Has User
    $app->post('/addPvHasUser', \App\Action\PvHasUserAction::class);
    //Item
    $app->post('/addItem', \App\Action\ItemCreateAction::class);
    $app->post('/updateItem', \App\Action\ItemUpdateAction::class);
};

<?php

use Slim\App;

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class);
    //User
    $app->post('/addUser', \App\Action\UserCreateAction::class);
    $app->get('/getAllUsers', \App\Action\UsersGetAllAction::class);
    $app->post('/updateUser', \App\Action\UserUpdateAction::class);
    $app->delete('/deleteUser', \App\Action\UserDeleteAction::class);

    //Affair
    $app->post('/addAffair', \App\Action\AffairCreateAction::class);
    $app->get('/getAllAffairs', \App\Action\AffairsGetAllAction::class);
    $app->get('/getAffairById', \App\Action\AffairGetByIdAction::class);
    $app->post('/updateAffair', \App\Action\AffairUpdateAction::class);
    $app->delete('/deleteAffair', \App\Action\AffairDeleteAction::class);
    //Lot
    $app->post('/addLot', \App\Action\LotCreateAction::class);
    $app->post('/updateLot', \App\Action\LotUpdateAction::class);
    $app->delete('/deleteLot', \App\Action\LotDeleteAction::class);
    //Pv
    $app->post('/addPv', \App\Action\PvCreateAction::class);
    $app->get('/getPvByAffairId', \App\Action\PvGetByAffairIdAction::class);
    $app->post('/updatePv', \App\Action\PvUpdateAction::class);
    $app->get('/getPvDetails', \App\Action\PvGetByIdAction::class);
    $app->delete('/deletePv', \App\Action\PvDeleteAction::class);
    //Pv Has User
    $app->post('/addPvHasUser', \App\Action\PvHasUserAction::class);
    //Item
    $app->post('/addItem', \App\Action\ItemCreateAction::class);
    $app->post('/updateItem', \App\Action\ItemUpdateAction::class);
    $app->delete('/deleteItem', \App\Action\ItemDeleteAction::class);
    //Tocken
    $app->post('/addToken', \App\Action\TokenCreateAction::class);
    $app->delete('/deleteToken', \App\Action\TokenDeleteAction::class);
    $app->get('/getTokensByUserId', \App\Action\TokensGetByUserIdAction::class);
    //Pv Has Item
    //TODO: créer une requete pour pouvoir mettre un item dans plusieurs Pv
    //TODO: faire des tests sur les suppressions
};

<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class HomeAction
{
    public function __invoke(ServerRequest $request, Response $response): Response
    {
        $result = ['Statut' => ['message' => 'Votre serveur fonctionne']];

        return $response->withJson($result)->withStatus(422);
    }
}

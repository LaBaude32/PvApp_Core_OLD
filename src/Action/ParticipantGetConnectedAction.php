<?php

namespace App\Action;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Service\UserGetter;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ParticipantGetConnectedAction
{
    private $UserGetter;

    public function __construct(UserGetter $UserGetter)
    {
        $this->UserGetter = $UserGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Invoke the Domain with inputs and retain the result
        $users = $this->UserGetter->getUsers();

        // Build the HTTP response
        return $response->withJson($users)->withStatus(201);
    }
}

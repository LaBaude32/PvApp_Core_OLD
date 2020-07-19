<?php

namespace App\Action;

use App\Domain\Pv\Service\PvGetter;
use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Service\UserGetter;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ParticipantGetConnectedAction
{
    private $UserGetter;
    protected $PvGetter;

    public function __construct(UserGetter $UserGetter, PvGetter $PvGetter)
    {
        $this->UserGetter = $UserGetter;
        $this->PvGetter = $PvGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        $userId = (int) htmlspecialchars($data['id_user']);

        //recuperer tous les pvs liés à cet user
        $pvs = $this->PvGetter->getAllPvByUserId($userId);
        //recuperer les personnes de tous ces pvs

        // Invoke the Domain with inputs and retain the result
        $users = $this->UserGetter->getUsers();

        // Build the HTTP response
        return $response->withJson($users)->withStatus(201);
    }
}

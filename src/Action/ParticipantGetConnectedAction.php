<?php

namespace App\Action;

use App\Domain\Pv\Service\PvGetter;
use App\Domain\PvHasUser\Service\PvHasUserGetter;
use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Service\UserGetter;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class ParticipantGetConnectedAction
{
    private $UserGetter;
    protected $PvGetter;
    protected $pHUGetter;

    public function __construct(UserGetter $UserGetter, PvGetter $PvGetter, PvHasUserGetter $pHUGetter)
    {
        $this->UserGetter = $UserGetter;
        $this->PvGetter = $PvGetter;
        $this->pHUGetter = $pHUGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getQueryParams();

        $userId = (int) htmlspecialchars($data['id_user']);

        //recuperer tous les pvs liés à cet user
        $pvs = $this->PvGetter->getAllPvByUserId($userId);
        //recuperer les personnes de tous ces pvs

        $connectedParticipants = $this->pHUGetter->getPvHasUsersFromPvs($pvs);

        // Build the HTTP response
        return $response->withJson($connectedParticipants)->withStatus(201);
    }
}

<?php

namespace App\Action;

use App\Domain\PvHasUser\Service\PvHasUserDeletor;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\User\Service\UserDeletor;

final class ParticipantDeleteAction
{
    protected $pvHasUserDeletor;

    public function __construct(PvHasUserDeletor $pvHasUserDeletor)
    {
        $this->pvHasUserDeletor = $pvHasUserDeletor;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getQueryParams();

        $pvHasUser['pv_id'] = (int) htmlspecialchars($data['id_pv']);
        $pvHasUser['user_id'] = (int) htmlspecialchars($data['id_user']);

        // Invoke the Domain with inputs and retain the result
        $this->pvHasUserDeletor->deletePvHasUser($pvHasUser);

        // Transform the result into the JSON representation
        $result = "success";

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

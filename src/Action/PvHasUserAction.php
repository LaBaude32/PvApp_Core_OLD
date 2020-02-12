<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Service\PvHasUserCreator;

final class PvHasUserAction
{
    private $pvHasUserCreator;

    public function __construct(PvHasUserCreator $pvHasUserCreator)
    {
        $this->pvHasUserCreator = $pvHasUserCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $pvHasUser = new PvHasUserData();
        $pvHasUser->pv_id = $data['pv_id'];
        $pvHasUser->user_id = $data['user_id'];
        $pvHasUser->status = $data['status'];

        // Invoke the Domain with inputs and retain the result
        $this->pvHasUserCreator->createPvHasUser($pvHasUser);

        // Transform the result into the JSON representation
        $result = [
            'Response' => 'Success'
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

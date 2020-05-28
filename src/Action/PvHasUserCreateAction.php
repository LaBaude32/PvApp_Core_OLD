<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Service\PvHasUserCreator;

final class PvHasUserCreateAction
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
        $pvHasUser->pv_id = htmlspecialchars($data['pv_id']);
        $pvHasUser->user_id = htmlspecialchars($data['user_id']);
        $pvHasUser->status_PAE = htmlspecialchars($data['status_PAE']);

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

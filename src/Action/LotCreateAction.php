<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Lot\Data\LotCreateData;
use App\Domain\Lot\Service\LotCreator;

final class LotCreateAction
{
    private $lotCreator;

    public function __construct(LotCreator $lotCreator)
    {
        $this->lotCreator = $lotCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $lot = new LotCreateData();
        $lot->name = $data['name'];
        $lot->affair_id = $data['affair_id'];

        // Invoke the Domain with inputs and retain the result
        $lotId = $this->lotCreator->createLot($lot);

        // Transform the result into the JSON representation
        $result = [
            'lot_id' => $lotId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

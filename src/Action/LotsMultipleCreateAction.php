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
        $affairId = $data['affair_id'];
        $lotsRecived = $data['lots_name'];
        foreach ($lotsRecived as $value) {
            $lot = new LotCreateData();
            $lot->name = $value;
            $lot->affair_id = $affairId;
            $lots[] = $lot;
        }

        // Invoke the Domain with inputs and retain the result
        $this->lotCreator->createLots($lots);

        // Transform the result into the JSON representation
        $result = [
            'result' => 'success'
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

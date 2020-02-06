<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Data\PvCreateData;
use App\Domain\Pv\Service\PvCreator;

final class PvCreateAction
{
    private $pvCreator;

    public function __construct(PvCreator $pvCreator)
    {
        $this->pvCreator = $pvCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $pv = new PvCreateData();
        $pv->state = $data['state'];
        $pv->meeting_date = $data['meeting_date'];
        $pv->meeting_place = $data['meeting_place'];
        $pv->meeting_next_date = $data['meeting_next_date'];
        $pv->meeting_next_place = $data['meeting_next_place'];
        $pv->affaire_id = $data['affaire_id'];

        // Invoke the Domain with inputs and retain the result
        $pvId = $this->pvCreator->createPv($pv);

        // Transform the result into the JSON representation
        $result = [
            'id_pv' => $pvId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

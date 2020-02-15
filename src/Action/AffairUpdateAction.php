<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Affair\Data\AffairGetData;
use App\Domain\Affair\Data\AffairUpdateData;
use App\Domain\Affair\Service\AffairUpdater;

final class AffairUpdateAction
{
    private $affairUpdater;

    public function __construct(AffairUpdater $affairUpdater)
    {
        $this->affairUpdater = $affairUpdater;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $affair = new AffairGetData();
        $affair->id_affair = $data['id_affair'];
        $affair->name = $data['name'];
        $affair->address = $data['address'];
        $affair->progress = $data['progress'];
        $affair->meeting_type = $data['meeting_type'];

        // Invoke the Domain with inputs and retain the result
        $affairId = $this->affairUpdater->updateAffair($affair);

        // Transform the result into the JSON representation
        $result = [
            'affair_id' => $affairId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

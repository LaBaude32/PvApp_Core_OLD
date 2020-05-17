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
        $affair->id_affair = htmlspecialchars($data['id_affair']);
        $affair->name = htmlspecialchars($data['name']);
        $affair->address = htmlspecialchars($data['address']);
        $affair->progress = htmlspecialchars($data['progress']);
        $affair->meeting_type = htmlspecialchars($data['meeting_type']);
        $affair->description = htmlspecialchars($data['description']);

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

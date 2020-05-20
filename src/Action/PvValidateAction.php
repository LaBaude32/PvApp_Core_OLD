<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Data\PvGetData;
use App\Domain\Pv\Service\PvUpdater;

final class PvValidateAction
{
    private $pvUpdater;

    public function __construct(PvUpdater $pvUpdater)
    {
        $this->pvUpdater = $pvUpdater;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)

        $idPv = (int) htmlspecialchars($data['id_pv']);

        // Invoke the Domain with inputs and retain the result
        $pvId = $this->pvUpdater->validatePv($idPv);

        // Transform the result into the JSON representation
        $result = "success";

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

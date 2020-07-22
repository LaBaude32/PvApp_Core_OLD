<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Data\PvGetData;
use App\Domain\Pv\Service\PvGetter;
use App\Domain\Pv\Service\PvUpdater;

final class PvUpdateAction
{
    private $pvUpdater;

    protected $pvGetter;

    public function __construct(PvUpdater $pvUpdater, PvGetter $pvGetter)
    {
        $this->pvUpdater = $pvUpdater;
        $this->pvGetter = $pvGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $pv = new PvGetData();
        $pv->id_pv = htmlspecialchars($data['id_pv']);
        $pv->state = htmlspecialchars($data['state']);
        if (!empty($data['meeting_date'])) {
            $pv->meeting_date = htmlspecialchars($data['meeting_date']);
        }
        $pv->meeting_place = htmlspecialchars($data['meeting_place']);
        if (!empty($data['meeting_next_date'])) {
            $pv->meeting_next_date = htmlspecialchars($data['meeting_next_date']);
        }
        $pv->meeting_next_place = htmlspecialchars($data['meeting_next_place']);
        $pv->affair_id = htmlspecialchars($data['affair_id']);

        // Invoke the Domain with inputs and retain the result
        $pvId = $this->pvUpdater->updatePv($pv);

        $pvToReturn = $this->pvGetter->getPvById($pvId);

        // Transform the result into the JSON representation
        $result = [
            'pv' => $pvToReturn
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Data\PvCreateData;
use App\Domain\Pv\Service\PvCreator;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Service\PvHasUserCreator;

final class PvCreateAction
{
    private $pvCreator;

    protected $pvHasUserCreator;

    public function __construct(PvCreator $pvCreator, PvHasUserCreator $pvHasUserCreator)
    {
        $this->pvCreator = $pvCreator;
        $this->pvHasUserCreator = $pvHasUserCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $pv = new PvCreateData();
        $pv->state = $data['state'];
        $pv->meeting_date = htmlspecialchars($data['meeting_date']);
        $pv->meeting_place = htmlspecialchars($data['meeting_place']);
        if (!empty($data['meeting_next_date'])) {
            $pv->meeting_next_date = (string) htmlspecialchars($data['meeting_next_date']);
        }
        $pv->meeting_next_place = htmlspecialchars($data['meeting_next_place']);
        $pv->affair_id = htmlspecialchars($data['affair_id']);

        // Invoke the Domain with inputs and retain the result
        $pvId = $this->pvCreator->createPv($pv);

        $pHU = new PvHasUserData();
        $pHU->pv_id = $pvId;
        $pHU->user_id = (int) htmlspecialchars($data['user_id']);
        $pHU->status_PAE = "Présent";
        $pHU->invited_current_meeting = 1;
        $pHU->invited_next_meeting = 1;
        $pHU->distribution = 1;
        $pHU->owner = 1;

        $this->pvHasUserCreator->createPvHasUser($pHU);

        // Transform the result into the JSON representation
        $result = [
            'id_pv' => $pvId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

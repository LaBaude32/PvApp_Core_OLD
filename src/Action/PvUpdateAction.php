<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Data\PvCreateData;
use App\Domain\Pv\Service\PvUpdater;

final class PvUpdateAction
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
        $pv = new PvCreateData();
        $pv->id_pv = $data['id_pv'];
        $pv->etat = $data['etat'];
        $pv->date_reunion = $data['date_reunion'];
        $pv->lieu_reunion = $data['lieu_reunion'];
        $pv->date_prochaine_reunion = $data['date_prochaine_reunion'];
        $pv->lieu_prochaine_reunion = $data['lieu_prochaine_reunion'];
        $pv->affaire_id = $data['affaire_id'];

        // var_dump($pv);
        // Invoke the Domain with inputs and retain the result
        $pvId = $this->pvUpdater->updatePv($pv);

        // Transform the result into the JSON representation
        $result = [
            'pv_id' => $pvId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

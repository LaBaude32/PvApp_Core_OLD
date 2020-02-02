<?php

namespace App\Action;

use App\Domain\Affaire\Data\AffaireCreateData;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Affaire\Service\AffaireCreator;

final class AffaireCreateAction
{
    private $affaireCreator;

    public function __construct(AffaireCreator $affaireCreator)
    {
        $this->affaireCreator = $affaireCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $affaire = new AffaireCreateData();
        $affaire->nom = $data['nom'];
        $affaire->adresse = $data['adresse'];
        $affaire->avancement = $data['avancement'];
        $affaire->type_reu = $data['type_reu'];

        // Invoke the Domain with inputs and retain the result
        $affaireId = $this->affaireCreator->createAffaire($affaire);

        // Transform the result into the JSON representation
        $result = [
            'affaire_id' => $affaireId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}
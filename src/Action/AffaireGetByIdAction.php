<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Affaire\Service\AffaireGetter;

final class AffaireGetByIdAction
{
    private $affaireGetter;

    public function __construct(AffaireGetter $affaireGetter)
    {
        $this->affaireGetter = $affaireGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
      // Collect input from the HTTP request
      $data = (array) $request->getParsedBody();

      $id = (int) $data['id_affaire'];
      
      // Invoke the Domain with inputs and retain the result
      $affaire = $this->affaireGetter->getAffaireById($id);

      // Build the HTTP response
      return $response->withJson($affaire)->withStatus(201);
    }
}
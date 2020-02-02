<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Affaire\Service\AffaireGetter;

final class AffairesGetAllAction
{
    private $affaireGetter;

    public function __construct(AffaireGetter $affaireGetter)
    {
        $this->affaireGetter = $affaireGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
      // Invoke the Domain with inputs and retain the result
      $affaires = $this->affaireGetter->getAllAffaires();

      // Build the HTTP response
      return $response->withJson($affaires)->withStatus(201);
    }
}
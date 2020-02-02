<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Affaire\Service\AffairesGetterAll;

final class AffairesGetAllAction
{
    private $affairesGetterAll;

    public function __construct(AffairesGetterAll $affairesGetterAll)
    {
        $this->affairesGetterAll = $affairesGetterAll;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
      // Invoke the Domain with inputs and retain the result
      $affaires = $this->affairesGetterAll->getAffaires();

      // Build the HTTP response
      return $response->withJson($affaires)->withStatus(201);
    }
}
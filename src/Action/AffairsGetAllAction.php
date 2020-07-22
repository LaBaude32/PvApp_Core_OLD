<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Affair\Service\AffairGetter;

final class AffairsGetAllAction
{
  private $affairGetter;

  public function __construct(AffairGetter $affairGetter)
  {
    $this->affairGetter = $affairGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Invoke the Domain with inputs and retain the result
    $affairs = $this->affairGetter->getAllAffairs();

    // Build the HTTP response
    return $response->withJson($affairs)->withStatus(201);
  }
}

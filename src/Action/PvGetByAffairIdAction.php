<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Service\PvGetter;

final class PvGetByAffairIdAction
{
  private $pvGetter;

  public function __construct(PvGetter $pvGetter)
  {
    $this->pvGetter = $pvGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getQueryParams();

    $id = (int) htmlspecialchars($data['id_affair']);

    // Invoke the Domain with inputs and retain the result
    $pvs = $this->pvGetter->getPvByAffairId($id);

    // Build the HTTP response
    return $response->withJson($pvs)->withStatus(201);
  }
}

<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Lot\Service\LotDeletor;

final class LotDeleteAction
{
  private $lotDeletor;

  public function __construct(LotDeletor $lotDeletor)
  {
    $this->lotDeletor = $lotDeletor;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getQueryParams();

    $id = (int) $data['id_lot'];

    // Invoke the Domain with inputs and retain the result
    $this->lotDeletor->deleteLot($id);

    $result = "success";

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

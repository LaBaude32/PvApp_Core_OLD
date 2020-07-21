<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Service\PvDeletor;

final class PvDeleteAction
{
  private $pvDeletor;

  public function __construct(PvDeletor $pvDeletor)
  {
    $this->pvDeletor = $pvDeletor;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getParsedBody();

    $id = (int) htmlspecialchars($data['id_pv']);

    // Invoke the Domain with inputs and retain the result
    $this->pvDeletor->deletePv($id);

    $result = ["Le pv a bien été supprimé"];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Affair\Service\AffairDeletor;

final class AffairDeleteAction
{
  private $affairDeletor;

  public function __construct(AffairDeletor $affairDeletor)
  {
    $this->affairDeletor = $affairDeletor;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getParsedBody();

    $id = (int) htmlspecialchars($data['id_affair']);

    // Invoke the Domain with inputs and retain the result
    $this->affairDeletor->deleteAffair($id);

    $result = ["l'affaire a bien été supprimée"];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Lot\Service\LotGetter;
use App\Domain\Affair\Service\AffairGetter;

final class AffairGetByIdAction
{
  private $affairGetter;
  protected $lotGetter;

  public function __construct(AffairGetter $affairGetter, LotGetter $lotGetter)
  {
    $this->affairGetter = $affairGetter;
    $this->lotGetter = $lotGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getQueryParams();

    $id = (int) $data['id_affair'];

    // Invoke the Domain with inputs and retain the result
    $affair = $this->affairGetter->getAffairById($id);
    $lots = $this->lotGetter->getLotByAffairId($affair->id_affair); //TODO: faire une joiture de table plutôt

    $affairWithLots = ["Infos Affair" => $affair, "lots" => $lots];

    // Build the HTTP response
    return $response->withJson($affairWithLots)->withStatus(201);
  }
}

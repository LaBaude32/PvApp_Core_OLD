<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Service\PvGetter;
use App\Domain\Affair\Service\AffairGetter;
use App\Domain\PvHasUser\Service\PvHasUserGetter;

final class AffairsGetByUserIdAction
{
  private $affairGetter;

  protected $pvHasUserGetter;

  protected $pvGetter;

  public function __construct(AffairGetter $affairGetter, PvHasUserGetter $pvHasUserGetter, PvGetter $pvGetter)
  {
    $this->affairGetter = $affairGetter;
    $this->pvHasUserGetter = $pvHasUserGetter;
    $this->pvGetter = $pvGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $params = (array) $request->getQueryParams();

    $userId = (int) htmlspecialchars($params['user_id']);

    // Invoke the Domain with inputs and retain the result

    //1. Recuperer les Pv correspondants à un user,
    $pvIds = $this->pvHasUserGetter->getPvByUserId($userId);

    $affairs = [];

    if (!empty($pvIds)) {
      $affairIds = $this->pvGetter->getAffairsIdByPvsId($pvIds);
      if (!empty($affairIds)) {
        //2. Recuperer les Affairs correspondantes aux pv.
        $affairs = $this->affairGetter->getAffairsByIds($affairIds);
      }
    }

    // Build the HTTP response
    return $response->withJson($affairs)->withStatus(201);
  }
}

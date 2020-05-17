<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Service\PvGetter;

final class PvsGetLastsByUserIdAction
{
  private $pvGetter;

  public function __construct(PvGetter $pvGetter)
  {
    $this->pvGetter = $pvGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $params = (array) $request->getQueryParams();

    $userId = (int) htmlspecialchars($params['user_id']);
    $numberOfPvs = (int) htmlspecialchars($params['number_of_pvs']);

    $data = [
      "userId" => $userId,
      "numberOfPvs" => $numberOfPvs
    ];

    // Invoke the Domain with inputs and retain the result
    $pvs = $this->pvGetter->getLastsPvByUserId($data);

    // Build the HTTP response 
    return $response->withJson($pvs)->withStatus(201);
  }
}

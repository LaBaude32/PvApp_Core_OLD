<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Lot\Service\LotGetter;
use App\Domain\Token\Service\TokenGetter;

final class TokensGetByUserIdAction
{
  private $tokenGetter;

  public function __construct(TokenGetter $tokenGetter)
  {
    $this->tokenGetter = $tokenGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getQueryParams();

    $userId = (int) $data['user_id'];

    // Invoke the Domain with inputs and retain the result
    $tokens = $this->tokenGetter->getTokensByUserId($userId);
    //TODO: faire cette fonction

    $result = ["Tokens" => $tokens];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

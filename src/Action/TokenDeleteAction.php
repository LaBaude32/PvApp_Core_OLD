<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Token\Service\TokenDeletor;

final class TokenDeleteAction
{
  private $tokenDeletor;

  public function __construct(TokenDeletor $tokenDeletor)
  {
    $this->tokenDeletor = $tokenDeletor;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getParsedBody();

    $token = (string) $data['token'];

    // Invoke the Domain with inputs and retain the result
    $this->tokenDeletor->deleteToken($token);

    $result = ["Le token à bien été supprimé"];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

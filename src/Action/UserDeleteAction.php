<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\User\Service\UserDeletor;

final class UserDeleteAction
{
  private $userDeletor;

  public function __construct(UserDeletor $userDeletor)
  {
    $this->userDeletor = $userDeletor;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getParsedBody();

    $id = (int) $data['id_user'];

    // Invoke the Domain with inputs and retain the result
    $this->userDeletor->deleteUser($id);

    $result = ["Le user a bien été supprimé"];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

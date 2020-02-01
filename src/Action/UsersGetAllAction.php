<?php

namespace App\Action;

use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Service\UsersGetterAll;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UsersGetAllAction
{
    private $UsersGetterAll;

    public function __construct(UsersGetterAll $UsersGetterAll)
    {
        $this->UsersGetterAll = $UsersGetterAll;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Invoke the Domain with inputs and retain the result
        $users = $this->UsersGetterAll->getUsers();

        // Build the HTTP response
        return $response->withJson($users)->withStatus(201);
    }
}

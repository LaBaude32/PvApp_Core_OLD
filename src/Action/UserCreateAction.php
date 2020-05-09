<?php

namespace App\Action;

use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Service\PvHasUserCreator;
use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Service\UserCreator;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class UserCreateAction
{
    private $userCreator;

    protected $pvHasUserCreator;

    public function __construct(UserCreator $userCreator, PvHasUserCreator $pvHasUserCreator)
    {
        $this->userCreator = $userCreator;
        $this->pvHasUserCreator = $pvHasUserCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $user = new UserCreateData();
        $user->email = $data['email'];
        $user->pwd = $data['password'];
        $user->firstName = $data['firstName'];
        $user->lastName = $data['lastName'];
        $user->phone = $data['phone'];
        $user->userGroup = $data['userGroup'];
        $user->userFunction = $data['user_function'];
        $user->organism = $data['organism'];

        // Invoke the Domain with inputs and retain the result
        $userId = $this->userCreator->createUser($user);



        if ($data['pvId'] != "") {
            $pvHasUser = new PvHasUserData();
            $pvHasUser->pv_id = $data['pvId'];
            $pvHasUser->user_id = $userId;
            $pvHasUser->status_PAE = $data['status_PAE'];

            $this->pvHasUserCreator->createPvHasUser($pvHasUser);
        }

        // Transform the result into the JSON representation
        $result = [
            'id_user' => $userId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use UnexpectedValueException;
use App\Domain\User\Data\UserGetData;
use App\Domain\User\Service\UserGetter;
use App\Domain\User\Service\UserUpdater;

final class UserUpdateAction
{
    private $userUpdater;

    protected $userGetter;

    public function __construct(UserUpdater $userUpdater, UserGetter $userGetter)
    {
        $this->userUpdater = $userUpdater;
        $this->userGetter = $userGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $user = new UserGetData();
        $user->id_user = htmlspecialchars($data['id_user']);
        $user->email = htmlspecialchars($data['email']);
        $user->pwd = htmlspecialchars($data['password']);
        $user->firstName = htmlspecialchars($data['first_name']);
        $user->lastName = htmlspecialchars($data['last_name']);
        $user->phone = htmlspecialchars($data['phone']);
        $user->userGroup = htmlspecialchars($data['userGroup']);
        $user->userFunction = htmlspecialchars($data['user_function']);
        $user->organism = htmlspecialchars($data['organism']);

        // Invoke the Domain with inputs and retain the result
        $this->userUpdater->updateUser($user);

        $newUser = $this->userGetter->getUserById($user->id_user);

        foreach ($newUser as $key => $value) {
            if ($user->$key !== $value) {
                throw new UnexpectedValueException('Erreur sur le ' . $key . ' qui est différent');
            }
        }

        // Transform the result into the JSON representation
        $result = [
            'id_user' => $newUser->id_user
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

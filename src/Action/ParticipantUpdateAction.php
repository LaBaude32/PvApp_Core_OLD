<?php

namespace App\Action;

use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Service\PvHasUserUpdater;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use UnexpectedValueException;
use App\Domain\User\Data\UserGetData;
use App\Domain\User\Service\UserGetter;
use App\Domain\User\Service\UserUpdater;

final class ParticipantUpdateAction
{
    private $userUpdater;
    protected $userGetter;

    protected $pvHasUserUpdater;

    public function __construct(UserUpdater $userUpdater, UserGetter $userGetter, PvHasUserUpdater $pvHasUserUpdater)
    {
        $this->userUpdater = $userUpdater;
        $this->userGetter = $userGetter;
        $this->pvHasUserUpdater = $pvHasUserUpdater;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $user = new UserGetData();
        $user->id_user = htmlspecialchars($data['id_user']);
        $user->email = htmlspecialchars($data['email']);
        $user->firstName = htmlspecialchars($data['firstName']);
        $user->lastName = htmlspecialchars($data['lastName']);
        $user->phone = htmlspecialchars($data['phone']);
        $user->userGroup = htmlspecialchars($data['userGroup']);
        $user->userFunction = htmlspecialchars($data['user_function']);
        $user->organism = htmlspecialchars($data['organism']);

        // Invoke the Domain with inputs and retain the result
        $this->userUpdater->updateParticipant($user);

        $newUser = $this->userGetter->getUserById($user->id_user);

        foreach ($newUser as $key => $value) {
            if ($user->$key !== $value && $key != "pwd") {
                throw new UnexpectedValueException('Erreur sur le ' . $key . ' qui est différent');
            }
        }

        // update Status_PAE
        $pvHasUser = new PvHasUserData();
        $pvHasUser->user_id = $newUser->id_user;
        $pvHasUser->pv_id = $data['pvId'];
        $pvHasUser->status_PAE = (string) $data['status_PAE'];

        $this->pvHasUserUpdater->updatePvHasUser($pvHasUser);

        $newUser = $this->userGetter->getUserWithStatusById($user->id_user);

        // Transform the result into the JSON representation
        $result = [
            'id_user' => $newUser->id_user
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

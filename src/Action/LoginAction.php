<?php

namespace App\Action;

use DateTime;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use UnexpectedValueException;
use App\Domain\Token\Data\TokenData;
use App\Domain\User\Service\UserGetter;
use App\Domain\User\Data\UserCreateData;
use App\Domain\Token\Service\TokenGetter;
use App\Domain\Token\Service\TokenCreator;
use App\Domain\Token\Service\TokenDeletor;

final class LoginAction
{
    private $userGetter;
    protected $tokenGetter;
    protected $tokenDeletor;
    protected $tokenCreator;

    public function __construct(UserGetter $userGetter, TokenGetter $tokenGetter, TokenDeletor $tokenDeletor, TokenCreator $tokenCreator)
    {
        $this->userGetter = $userGetter;
        $this->tokenGetter = $tokenGetter;
        $this->tokenDeletor = $tokenDeletor;
        $this->tokenCreator = $tokenCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $userLogged = new UserCreateData();
        $userLogged->email = $data['email'];
        $userLogged->pwd = $data['password'];

        // Invoke the Domain with inputs and retain the result
        $userRegistred = $this->userGetter->identifyUser($userLogged->email);

        if (empty($userRegistred->email)) {
            // throw new UnexpectedValueException("Erreur sur l'email ou le mot de passe");
            $result = [
                'login_result' => 'error',
                'message' => 'Identifiant ou mot de passe incorrect'
            ];
        }

        //Check if user pwd is good
        if (password_verify($userLogged->pwd, $userRegistred->pwd)) {

            // Transform the result into the JSON representation
            $result = [
                'login_result' => "success",
                'user_id' => $userRegistred->id_user,
                'user_data' => $userRegistred
            ];
        } else {
            $result = [
                'login_result' => 'error',
                'message' => 'Identifiant ou mot de passe incorrect'
            ];
        }

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

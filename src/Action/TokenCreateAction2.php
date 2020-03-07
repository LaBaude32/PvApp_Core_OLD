<?php

namespace App\Action;

use DateTime;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use UnexpectedValueException;
use App\Domain\Token\Data\TokenData;
use App\Domain\Token\Service\TokenGetter;
use App\Domain\Token\Service\TokenCreator;

final class TokenCreateAction2
{
    private $tokenCreator;

    protected $tokenGetter;

    public function __construct(TokenCreator $tokenCreator, TokenGetter $tokenGetter)
    {
        $this->tokenCreator = $tokenCreator;
        $this->tokenGetter = $tokenGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        $date = new DateTime();
        $date->modify('+24hours');

        // Mapping (should be done in a mapper class)
        $token = new TokenData();
        $token->device = $data['device'];
        $token->expirationDate = $date->format('Y-m-d H:i:s');
        $token->userId = $data['user_id'];
        // Génération automatique du token de 44 valeurs
        $token->token = bin2hex(openssl_random_pseudo_bytes(22));

        // Invoke the Domain with inputs and retain the result
        $this->tokenCreator->createToken($token);

        $newToken = $this->tokenGetter->getTokenById($token->token);

        if ($newToken->token !== $token->token) {
            throw new UnexpectedValueException('Erreur : le token est différent');
        }

        // Transform the result into the JSON representation
        $result = [
            'user_id' => $newToken->userId,
            'token' => $newToken->token
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

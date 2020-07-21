<?php

namespace App\Action;

use App\Auth\JwtAuth;
use App\Domain\User\Service\UserAuth;
use Slim\Http\Response;
use Slim\Http\ServerRequest;

final class TokenCreateAction
{
  private $jwtAuth;

  protected $userAuth;

  public function __construct(JwtAuth $jwtAuth, UserAuth $userAuth)
  {
    $this->jwtAuth = $jwtAuth;
    $this->userAuth = $userAuth;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    $data = (array) $request->getParsedBody();

    $email = (string) ($data['email'] ?? '');
    $password = (string) ($data['password'] ?? '');


    $datas = [
      "email" => $email,
      "password" => $password
    ];
    // Validate login (pseudo code)
    $isValidLogin = $this->userAuth->checkLogin($datas);

    if (!$isValidLogin) {
      // Invalid authentication credentials
      return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(401, 'Unauthorized');
    }

    // Create a fresh token
    $token = $this->jwtAuth->createJwt($email);
    $lifetime = $this->jwtAuth->getLifetime();

    // Transform the result into a OAuh 2.0 Access Token Response
    // https://www.oauth.com/oauth2-servers/access-tokens/access-token-response/
    $result = [
      'access_token' => $token,
      'token_type' => 'Bearer',
      'expires_in' => $lifetime,
    ];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

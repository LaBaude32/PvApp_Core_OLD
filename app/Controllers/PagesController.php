<?php

namespace App\Controllers;

use App\Database\Database;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

require __DIR__ . '/../Model/Database.php';

class PagesController extends Controller
{
    public function home(ServerRequest $request, Response $response, $args)
    {
        $users = $this->container->get('db')->query('SELECT * FROM users');
        return $response->withJson($users);
    }
}

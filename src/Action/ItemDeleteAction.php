<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Item\Service\ItemDeletor;

final class ItemDeleteAction
{
  private $itemDeletor;

  public function __construct(ItemDeletor $itemDeletor)
  {
    $this->itemDeletor = $itemDeletor;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getParsedBody();

    $id = (int) $data['id_item'];

    // Invoke the Domain with inputs and retain the result
    $this->itemDeletor->deleteItem($id);

    $result = ["l'item a bien été supprimé"];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

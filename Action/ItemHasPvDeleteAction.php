<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Item\Service\ItemDeletor;

final class ItemHasPvDeleteAction
{
  private $itemDeletor;

  public function __construct(ItemDeletor $itemDeletor)
  {
    $this->itemDeletor = $itemDeletor;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getQueryParams();

    $itemHasPv['id_item'] = (int) htmlspecialchars($data['id_item']);
    $itemHasPv['id_pv'] = (int) htmlspecialchars($data['id_pv']);

    // Invoke the Domain with inputs and retain the result
    $this->itemDeletor->deleteItemHasPv($itemHasPv);

    $result = "success";

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

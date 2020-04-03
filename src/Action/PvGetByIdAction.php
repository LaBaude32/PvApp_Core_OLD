<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Service\PvGetter;
use App\Domain\Item\Service\ItemGetter;
use App\Domain\User\Service\UserGetter;

final class PvGetByIdAction
{
  private $pvGetter;
  private $itemGetter;
  private $userGetter;

  public function __construct(PvGetter $pvGetter, ItemGetter $itemGetter, UserGetter $userGetter)
  {
    $this->pvGetter = $pvGetter;
    $this->itemGetter = $itemGetter;
    $this->userGetter = $userGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getQueryParams();

    $id = (int) $data['id_pv'];

    // Invoke the Domain with inputs and retain the result
    $pv = $this->pvGetter->getPvById($id);
    $pv = $this->pvGetter->getLotsForPv($pv);

    $items = $this->itemGetter->getItemsByPvId($id);

    $itemsWithLots = $this->itemGetter->getLotsForItems($items);

    $users = $this->userGetter->getUsersByPvId($id);

    //TODO: Ajout de la récupération des status

    if (empty($items)) {
      $items = "Ce pv n'a pas encore d'items";
    }

    $result = [
      'pv_details' => $pv,
      'items' => $itemsWithLots,
      'users' => $users
    ];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

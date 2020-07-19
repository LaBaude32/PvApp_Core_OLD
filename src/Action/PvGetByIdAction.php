<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Service\PvGetter;
use App\Domain\Item\Service\ItemGetter;
use App\Domain\PvHasUser\Service\PvHasUserGetter;
use App\Domain\User\Service\UserGetter;

final class PvGetByIdAction
{
  private $pvGetter;
  private $itemGetter;
  private $userGetter;

  protected $pHUGetter;

  public function __construct(PvGetter $pvGetter, ItemGetter $itemGetter, UserGetter $userGetter, PvHasUserGetter $pHUGetter)
  {
    $this->pvGetter = $pvGetter;
    $this->itemGetter = $itemGetter;
    $this->userGetter = $userGetter;
    $this->pHUGetter = $pHUGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getQueryParams();

    $id = (int) htmlspecialchars($data['id_pv']);
    $userId = (int) htmlspecialchars($data['id_user']);

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

    //CONNECTED PARTICIPANTS
    //recuperer tous les pvs liés à cet user
    $pvs = $this->pvGetter->getAllPvByUserId($userId);
    //recuperer les personnes de tous ces pvs

    $connectedParticipants = $this->pHUGetter->getPvHasUsersFromPvs($pvs);

    $result = [
      'pv_details' => $pv,
      'items' => $itemsWithLots,
      'users' => $users,
      'connectedParticipants' => $connectedParticipants
    ];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

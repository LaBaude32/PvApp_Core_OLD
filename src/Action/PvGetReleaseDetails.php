<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Service\PvGetter;
use App\Domain\Item\Service\ItemGetter;
use App\Domain\PvHasUser\Service\PvHasUserGetter;
use App\Domain\User\Service\UserGetter;
use App\Action\AffairGetByIdAction;

final class PvGetReleaseDetails
{
  private $pvGetter;
  private $itemGetter;
  private $userGetter;
  protected $pvHasUserGetter;

  protected $getAffairByIdAction;

  public function __construct(PvGetter $pvGetter, ItemGetter $itemGetter, UserGetter $userGetter, PvHasUserGetter $pvHasUserGetter, AffairGetByIdAction $getAffairByIdAction)
  {
    $this->pvGetter = $pvGetter;
    $this->itemGetter = $itemGetter;
    $this->userGetter = $userGetter;
    $this->pvHasUserGetter = $pvHasUserGetter;
    $this->getAffairByIdAction = $getAffairByIdAction;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getQueryParams();

    $id = (int) $data['id_pv'];

    // Invoke the Domain with inputs and retain the result
    $pv = $this->pvGetter->getPvById($id);
    $pv = $this->pvGetter->getPvNumber($pv);

    $items = $this->itemGetter->getItemsByPvId($id);

    $itemsWithLots = $this->itemGetter->getLotsForItems($items);

    $users = $this->userGetter->getUsersByPvId($id);

    $owner = $this->pvHasUserGetter->getPvOwner($pv);

    $affair = $this->getAffairByIdAction->getAffairByIdDataWithLots($pv->affair_id);

    $result = [
      'pv_details' => $pv,
      'items' => $itemsWithLots,
      'users' => $users,
      'owner' => $owner,
      'affair' => $affair
    ];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

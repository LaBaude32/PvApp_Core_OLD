<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Service\PvGetter;
use App\Domain\Item\Service\ItemGetter;

final class PvGetByIdAction
{
  private $pvGetter;

  protected $itemGetter;

  /**
   * __construct
   *
   * @param  mixed $pvGetter
   * @param  mixed $itemGetter
   *
   * @return void
   */

  public function __construct(PvGetter $pvGetter, ItemGetter $itemGetter)
  {
    $this->pvGetter = $pvGetter;
    $this->itemGetter = $itemGetter;
  }

  public function __invoke(ServerRequest $request, Response $response): Response
  {
    // Collect input from the HTTP request
    $data = (array) $request->getParsedBody();

    $id = (int) $data['id_pv'];

    // Invoke the Domain with inputs and retain the result
    $pv = $this->pvGetter->getPvById($id);

    $items = $this->itemGetter->getItemsByPvId($id);

    $result = [
      'pv_details' => $pv,
      'items' => $items
    ];

    // Build the HTTP response
    return $response->withJson($result)->withStatus(201);
  }
}

<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Item\Data\ItemCreateData;
use App\Domain\Item\Service\ItemCreator;

final class ItemCreateAction
{
    private $itemCreator;

    public function __construct(ItemCreator $itemCreator)
    {
        $this->itemCreator = $itemCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $item = new ItemCreateData();
        $item->position = $data['position'];
        $item->note = $data['note'];
        $item->follow_up = $data['follow_up'];
        $item->ressources = $data['ressources'];
        $item->completion = $data['completion'];
        $item->completion_date = $data['completion_date'];
        $item->visible = $data['visible'];
        $item->created_at = $data['created_at'];
        $item->pv_id = $data['pv_id'];

        // Invoke the Domain with inputs and retain the result
        $itemId = $this->itemCreator->createItem($item);

        // Transform the result into the JSON representation
        $result = [
            'id_item' => $itemId
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

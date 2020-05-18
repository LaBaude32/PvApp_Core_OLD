<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Item\Data\ItemCreateData;
use App\Domain\Item\Service\ItemCreator;
use App\Domain\Lot\Service\LotCreator;

final class ItemCreateAction
{
    private $itemCreator;

    protected $lotCreator;

    public function __construct(ItemCreator $itemCreator, LotCreator $lotCreator)
    {
        $this->itemCreator = $itemCreator;
        $this->lotCreator = $lotCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $item = new ItemCreateData();
        $item->position = htmlspecialchars($data['position']);
        $item->note = htmlspecialchars($data['note']);
        $item->follow_up = htmlspecialchars($data['follow_up']);
        $item->ressources = htmlspecialchars($data['ressources']);
        $item->completion = htmlspecialchars($data['completion']);
        $item->completion_date = htmlspecialchars($data['completion_date']);
        $item->visible = (int) htmlspecialchars($data['visible']);
        $item->created_at = htmlspecialchars($data['created_at']);
        $item->pv_id = (int) htmlspecialchars($data['pv_id']);
        $item->lots_ids = (array) htmlspecialchars($data['lots_ids']);

        // Invoke the Domain with inputs and retain the result
        $itemId = $this->itemCreator->createItem($item);

        if ($item->lots_ids != [""]) {
            $this->lotCreator->linkLotsToItem($item->lots_ids, $itemId);
        }

        // Transform the result into the JSON representation
        $result = [
            'id_item' => $itemId
        ];

        //TODO: recuperer et renvoyer la position en plus de l'ID

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

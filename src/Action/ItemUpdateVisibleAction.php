<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use UnexpectedValueException;
use App\Domain\Item\Data\ItemGetData;
use App\Domain\Item\Service\ItemGetter;
use App\Domain\Item\Data\ItemCreateData;
use App\Domain\Item\Service\ItemUpdater;

final class ItemUpdateVisibleAction
{
    private $itemUpdater;

    protected $itemGetter;

    public function __construct(ItemUpdater $itemUpdater, ItemGetter $itemGetter)
    {
        $this->itemUpdater = $itemUpdater;
        $this->itemGetter = $itemGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $item = new ItemGetData();
        $item->id_item = (int) htmlspecialchars($data['id_item']);
        $item->visible = (int) htmlspecialchars($data['visible']);

        // Invoke the Domain with inputs and retain the result
        $this->itemUpdater->updateVisible($item);

        $newItem = $this->itemGetter->getItemById($item->id_item);


        if ($newItem->visible !== $item->visible) {
            throw new UnexpectedValueException('Erreur, la valeur est différente');
        }

        // Transform the result into the JSON representation
        $result = [
            'id_item_updated' => $newItem->id_item
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use UnexpectedValueException;
use App\Domain\Item\Data\ItemGetData;
use App\Domain\Item\Service\ItemGetter;
use App\Domain\Item\Data\ItemCreateData;
use App\Domain\Item\Service\ItemUpdater;

final class ItemUpdateAction
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
        $item->id_item = (int) $data['id_item'];
        $item->position = $data['position'];
        $item->note = $data['note'];
        $item->follow_up = $data['follow_up'];
        $item->ressources = $data['ressources'];
        $item->completion = $data['completion'];
        $item->completion_date = $data['completion_date'];
        $item->visible = $data['visible'];
        $item->created_at = $data['created_at'];

        // Invoke the Domain with inputs and retain the result
        $this->itemUpdater->updateItem($item);

        $newItem = $this->itemGetter->getItemById($item->id_item);

        // var_dump($newItem);
        // var_dump($item);

        foreach ($newItem as $key => $value) {
            if ($item->$key !== $value) {
                throw new UnexpectedValueException('Erreur sur le ' . $key . ' qui est différent');
            }
        }


        // Transform the result into the JSON representation
        $result = [
            'id_item updated' => $newItem->id_item
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

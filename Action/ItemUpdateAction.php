<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use UnexpectedValueException;
use App\Domain\Item\Data\ItemGetData;
use App\Domain\Item\Service\ItemGetter;
use App\Domain\Item\Service\ItemDeletor;
use App\Domain\Item\Service\ItemUpdater;
use App\Domain\Lot\Service\LotCreator;

final class ItemUpdateAction
{
    private $itemUpdater;
    protected $itemGetter;
    protected $itemDeletor;
    protected $lotCreator;

    public function __construct(ItemUpdater $itemUpdater, ItemGetter $itemGetter, ItemDeletor $itemDeletor, LotCreator $lotCreator)
    {
        $this->itemUpdater = $itemUpdater;
        $this->itemGetter = $itemGetter;
        $this->itemDeletor = $itemDeletor;
        $this->lotCreator = $lotCreator;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $item = new ItemGetData();
        $item->id_item = (int) htmlspecialchars($data['id_item']);
        $item->position = (int) htmlspecialchars($data['position']);
        $item->note = htmlspecialchars($data['note']);
        $item->follow_up = htmlspecialchars($data['follow_up']);
        $item->ressources = htmlspecialchars($data['ressources']);
        if (!empty($data['completion_date'])) {
            $item->completion_date = htmlspecialchars($data['completion_date']);
        }
        $item->completion = (string) htmlspecialchars($data['completion']);
        $item->visible = (int) htmlspecialchars($data['visible']);
        $item->created_at = htmlspecialchars($data['created_at']);
        $item->lots_ids = (array) $data['lots'];

        // Invoke the Domain with inputs and retain the result
        $this->itemUpdater->updateItem($item);

        $newItem = $this->itemGetter->getItemById($item->id_item);

        foreach ($newItem as $key => $value) {
            if ($item->$key !== $value && $key != "completion_date" && $key != "lots_ids") {
                $oldValue = $item->$key;
                throw new UnexpectedValueException("$key est different.
                API : $oldValue - new value Valeur : $value ");
            }
        }

        // Recupéré les lots éxistants
        $itemWithLots = $this->itemGetter->getLotsForItem($newItem);

        // Les supprimer
        if (!empty($itemWithLots->lots)) {
            $this->itemDeletor->deleteItemHasLot($itemWithLots);
        }

        // Ajouter les nouveaux
        if (!empty($item->lots_ids)) {
            $this->lotCreator->linkLotsToItem($item->lots_ids, $newItem->id_item);
        }

        //Récupéré tout l'item avec les nouveaux lots
        $itemToSend = $this->itemGetter->getLotsForItem($newItem);

        // Transform the result into the JSON representation
        $result = [
            'item_updated' => $itemToSend
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}

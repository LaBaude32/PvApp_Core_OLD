<?php

namespace App\Domain\Item\Service;

use UnexpectedValueException;
use App\Domain\Item\Data\ItemGetData;
use App\Domain\Item\Repository\ItemUpdaterRepository;

/**
 * Service.
 */
final class ItemUpdater
{
    /**
     * @var ItemUpdaterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ItemUpdaterRepository $repository The repository
     */
    public function __construct(ItemUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get a new Affaire.
     *
     * @param ItemGetData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function updateItem(ItemGetData $item): int
    {
        // Validation
        if (empty($item->id_item)) {
            throw new UnexpectedValueException('id required');
        }

        // Insert Item
        $itemId = $this->repository->updateItem($item);

        //TODO: SESSION trouver une technique pour recuperer l'erreur quand rien n'est update

        // Logging here: Item Get successfully

        return $itemId;
    }
}

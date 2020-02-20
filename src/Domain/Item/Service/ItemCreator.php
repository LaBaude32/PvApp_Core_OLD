<?php

namespace App\Domain\Item\Service;

use UnexpectedValueException;
use App\Domain\Item\Data\ItemCreateData;
use App\Domain\Item\Repository\ItemCreatorRepository;

/**
 * Service.
 */
final class ItemCreator
{
    /**
     * @var ItemCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ItemCreatorRepository $repository The repository
     */
    public function __construct(ItemCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affaire.
     *
     * @param ItemCreateData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function createItem(ItemCreateData $item): int
    {
        // Validation
        if (empty($item->position)) {
            throw new UnexpectedValueException('position required');
        }

        if (empty($item->note)) {
            throw new UnexpectedValueException('note required');
        }

        if ($item->visible !== 0 && $item->visible !== 1) {
            throw new UnexpectedValueException('visible required, doit être numérique');
        }

        if (empty($item->pv_id)) {
            throw new UnexpectedValueException('pv_id required');
        }

        // Insert item
        $itemId = $this->repository->insertItem($item);

        $ids = ["pvId" => $item->pv_id, "itemId" => $itemId];

        $this->repository->insertPvHasItem($ids);

        // Logging here: item created successfully

        return (int) $itemId;
    }
}

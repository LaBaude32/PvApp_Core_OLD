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
    public function createItem(ItemCreateData $item, $pvId): int
    {
        // Validation
        if (empty($item->position)) {
            throw new UnexpectedValueException('position required');
        }

        if (empty($item->note)) {
            throw new UnexpectedValueException('note required');
        }

        if (empty($item->visible)) {
            throw new UnexpectedValueException('visible required');
        }

        // Insert item
        $itemId = $this->repository->insertItem($item);

        //TODO: inserer un item_has_pv en passant en paramettre le $pvId et le $itemId

        // Logging here: item created successfully

        return $itemId; //TODO: array ?
    }
}

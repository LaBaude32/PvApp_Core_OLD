<?php

namespace App\Domain\Item\Service;

use UnexpectedValueException;
use App\Domain\Item\Data\ItemCreateData;
use App\Domain\Item\Repository\ItemDeletorRepository;

/**
 * Service.
 */
final class ItemDeletor
{
    /**
     * @var ItemDeletorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ItemDeletorRepository $repository The repository
     */
    public function __construct(ItemDeletorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteItem(int $itemId)
    {
        // Validation
        if (empty($itemId)) {
            throw new UnexpectedValueException('Id required');
        }

        // delete Item
        $this->repository->deleteItem($itemId);

        // Logging here: Item created successfully
    }
}

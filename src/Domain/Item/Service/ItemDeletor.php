<?php

namespace App\Domain\Item\Service;

use UnexpectedValueException;
use App\Domain\Item\Data\ItemGetData;
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

    public function deleteItemHasPv(array $data)
    {
        // Validation
        if (empty($data['id_item'])) {
            throw new UnexpectedValueException('item id required');
        }

        // Validation
        if (empty($data['id_pv'])) {
            throw new UnexpectedValueException('pv id required');
        }

        $this->repository->deleteItemHasPv($data);
    }

    public function deleteItemHasLot(ItemGetData $item)
    {
        // Validation
        if (empty($item->lots)) {
            throw new UnexpectedValueException('lots required');
        }

        $this->repository->deleteItemHasLots($item);
    }
}

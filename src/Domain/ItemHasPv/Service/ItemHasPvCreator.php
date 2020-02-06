<?php

namespace App\Domain\ItemHasPv\Service;

use UnexpectedValueException;
use App\Domain\ItemHasPv\Data\ItemHasPvData;
use App\Domain\ItemHasPv\Repository\ItemHasPvCreatorRepository;

/**
 * Service.
 */
final class ItemHasPvCreator
{
    /**
     * @var ItemHasPvCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ItemHasPvCreatorRepository $repository The repository
     */
    public function __construct(ItemHasPvCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affaire.
     *
     * @param ItemHasPvData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function createItemHasPv(ItemHasPvData $itemHasPv): int
    {
        // Validation
        if (empty($itemHasPv->item_id)) {
            throw new UnexpectedValueException('item id required');
        }

        if (empty($itemHasPv->pv_id)) {
            throw new UnexpectedValueException('item pv required');
        }

        // Insert itemHasPv
        $itemHasPvId = $this->repository->insertItemHasPv($itemHasPv);

        // Logging here: itemHasPv created successfully

        return $itemHasPvId;
    }
}

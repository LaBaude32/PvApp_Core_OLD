<?php

namespace App\Domain\Item\Service;

use UnexpectedValueException;
use App\Domain\Item\Repository\ItemGetterRepository;

/**
 * Service.
 */
final class ItemGetter
{
    /**
     * @var ItemGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param ItemGetterRepository $repository The repository
     */
    public function __construct(ItemGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    // /**
    //  * Get all the pvs.
    //  *
    //  * @return array All the pvs
    //  */
    // public function getPvByPvId(int $id): array
    // {
    //     // Validation
    //     if (empty($id)) {
    //         throw new UnexpectedValueException('id required');
    //     }

    //     if ($id == 0) {
    //         throw new UnexpectedValueException('id doit Ãªtre positif');
    //     }

    //     // Get All pvs
    //     $pvs = $this->repository->getPvByAffaireId($id);

    //     return (array) $pvs;
    // }

    /**
     * Get all the items.
     *
     * @return array All the items
     */
    public function getAllItems(): array
    {
        // Get All items
        $items = $this->repository->getAllItems();

        return (array) $items;
    }

    /**
     * Get all the items.
     *
     * @return array All the items
     */
    public function getItemsByPvId($id): array
    {
        // Get All items
        $items = $this->repository->getItemsByPvId($id);

        return (array) $items;
    }
}

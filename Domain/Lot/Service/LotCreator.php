<?php

namespace App\Domain\Lot\Service;

use UnexpectedValueException;
use App\Domain\Lot\Data\LotCreateData;
use App\Domain\Lot\Repository\LotCreatorRepository;

/**
 * Service.
 */
final class LotCreator
{
    /**
     * @var LotCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LotCreatorRepository $repository The repository
     */
    public function __construct(LotCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Lot.
     *
     * @param LotCreateData $Lot The Lot data
     *
     * @return int The new Lot ID
     */
    public function createLot(LotCreateData $lot): int
    {
        // Validation
        if (empty($lot->name)) {
            throw new UnexpectedValueException('Nom required');
        }

        // Insert lot
        $lotId = $this->repository->insertLot($lot);

        // Logging here: lot created successfully

        return $lotId;
    }

    /**
     * Create a new Lot.
     *
     * @param LotCreateData $Lot The Lot data
     *
     * @return int The new Lot ID
     */
    public function createLots(array $lots): array
    {
        // Validation
        if (empty($lots[0])) {
            throw new UnexpectedValueException('Nom required');
        }

        // Insert lot
        $lotsIds = $this->repository->insertLots($lots);

        return (array) $lotsIds;
    }

    /**
     * Create a new Lot.
     *
     * @param LotCreateData $Lot The Lot data
     *
     * @return int The new Lot ID
     */
    public function linkLotsToItem(array $lotsIds, int $itemId): array
    {
        // Validation
        if (empty($lotsIds[0])) {
            throw new UnexpectedValueException('lots required');
        }

        if (empty($itemId)) {
            throw new UnexpectedValueException('item id required');
        }

        // Insert lot
        $lotsIds = $this->repository->linkLotsToItem($lotsIds, $itemId);

        return (array) $lotsIds;
    }
}
